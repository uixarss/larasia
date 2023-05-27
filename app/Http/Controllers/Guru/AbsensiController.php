<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use React\Http\Browser;
use App\Models\AbsensiSiswa;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\AbsensiGuru;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiSiswaExport;
use App\Models\AbsensiDosen;
use App\Models\AbsensiMahasiswa;
use App\Models\AbsensiDosenSP;
use App\Models\AbsensiMahasiswaSP;
use App\Models\Mahasiswa;
use App\Models\KelasMahasiswa;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Waktu;
use App\Models\DataSP;
use App\Models\Jadwal;
use App\Models\JadwalSP;
use App\Models\JadwalPengganti;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Helpers\GlobalFunction;
use App\Exports\AbsensiMahasiswaExport;
use App\Models\KrsMahasiswaEkstensi;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:dosen']);
    }
    //
    public function guru(Request $request)
    {
        if (Gate::denies('view-absensi-dosen')) {
            abort(403, 'User does not have the right permissions.');
        }
        $guru = Dosen::where('user_id', Auth::user()->id)->first();
        if ($guru) {
            $data_absensi = AbsensiDosen::where('id_dosen', $guru->id)
                // ->orderBy('created_at','ASC')
                ->get();
        } else {
        }
        return view('guru.absensiguru.index', [
            'data_absensi' => $data_absensi
        ]);
    }

    public function dosenAbsen()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $data_absensi_dosen = AbsensiDosen::where('id_dosen', $dosen->id)->get();

        return view('guru.absensidosen.index', [
            'data_absensi_dosen' => $data_absensi_dosen
        ]);
    }

    public function dosenAbsenPenggantiMasuk(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari_id' => 'required',
        ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $dosen = Dosen::where('user_id', Auth::id())->first();
        

        $data_terlambat = 15 * 60;
        if ($dosen == null) {
            return abort(403, 'Permission Denied');
        }
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));


        $absensi_dosen = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)
            ->count();
        $id_jadwal = JadwalPengganti::where('tahun_ajaran_id', $request->id_tahun_ajaran)
            ->where('semester_id', $request->id_semester)->where('prodi_id', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('waktu_id', $request->waktu_id)->first();

        if (($absensi_dosen > 0)) {
            return redirect()->back()->with([
                'error' => 'Sudah absen masuk'
            ]);
        } else {
            
            AbsensiDosen::create([
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_semester' => $request->id_semester,
                'id_prodi' => $request->id_prodi,
                'id_dosen' => $dosen->id,
                'mapel_id' => $request->mapel_id,
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'waktu_id' => $request->waktu_id,
                'keterangan' => 'Pengganti',
                'pertemuan_ke' => $request->pertemuan_ke,
                'tanggal_masuk' => $date,
                'jam_masuk' => $time,
                'status' => 'Hadir',
                'long' => $new_arr[0]['geoplugin_longitude'],
                'lat' => $new_arr[0]['geoplugin_latitude'],
                'ip_address' => $this->getIp(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]);

            // Membuat Absensi Mahasiswa
            $data_mahasiswa = Mahasiswa::where('kelas_id', $request->kelas_id)->get();
            foreach ($data_mahasiswa as $mahasiswa) {
                AbsensiMahasiswa::create([
                    'id_tahun_ajaran' => $request->id_tahun_ajaran,
                    'id_semester' => $request->id_semester,
                    'id_prodi' => $request->id_prodi,
                    'id_dosen' => $dosen->id,
                    'id_mahasiswa' => $mahasiswa->id,
                    'mapel_id' => $request->mapel_id,
                    'hari_id' => $request->hari_id,
                    'kelas_id' => $request->kelas_id,
                    'waktu_id' => $request->waktu_id,
                    'tanggal_masuk' => $date,
                    'status' => 'Alpha',
                    'pertemuan_ke' => $request->pertemuan_ke,
                    'keterangan' => 'Pengganti',
                    'id_jadwal' => $id_jadwal->id
                ]);
            }


            return redirect()->back()->with([
                'success' => 'Berhasil absen masuk'
            ]);
            // }
        }
    }



    public function dosenAbsenMasuk(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari_id' => 'required',

        ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $dosen = Dosen::where('user_id', Auth::id())->first();
        // $waktu = Waktu::find($request->waktu_id);
        // $str_time = strtotime($time);
        // $str_jam_masuk = strtotime($waktu->jam_masuk);
        // $selisih_waktu = $str_time - $str_jam_masuk;
        // $jam    = floor($selisih_waktu / (60 * 60));
        // $menit    = $selisih_waktu - $jam * (60 * 60);

        $data_terlambat = 15 * 60;
        if ($dosen == null) {
            return abort(403, 'Permission Denied');
        }
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));


        $absensi_dosen = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)
            ->count();
       
        $id_jadwal = Jadwal::where('tahun_ajaran_id', $request->id_tahun_ajaran)
            ->where('semester_id', $request->id_semester)->where('prodi_id', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)->where('waktu_id', $request->waktu_id)->first();
        
        //dd($id_jadwal->id);

        if (($absensi_dosen > 0)) {
            return redirect()->back()->with([
                'error' => 'Sudah absen masuk'
            ]);
        } else {
            // dd($menit);
            // if ($menit - $data_terlambat > 15) {
            //     return redirect()->back()->with([
            //         'error' => 'Sudah melewati batas waktu, silahkan hubungi admin akademik'
            //     ]);
            // } else {
            // hitung pertemuan
            $pertemuan = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
                ->where('id_semester', $request->id_semester)->where('id_dosen', $dosen->id)
                ->where('hari_id', $request->hari_id)->where('mapel_id', $request->mapel_id)
                ->where('kelas_id', $request->kelas_id)->where('waktu_id', $request->waktu_id)
                ->orderBy('pertemuan_ke', 'desc')->value('pertemuan_ke');
            AbsensiDosen::create([
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_semester' => $request->id_semester,
                'id_prodi' => $request->id_prodi,
                'id_dosen' => $dosen->id,
                'mapel_id' => $request->mapel_id,
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'waktu_id' => $request->waktu_id,
                'pertemuan_ke' => ++$pertemuan ?? '1',
                'tanggal_masuk' => $date,
                'jam_masuk' => $time,
                'status' => 'Hadir',
                'long' => $new_arr[0]['geoplugin_longitude'],
                'lat' => $new_arr[0]['geoplugin_latitude'],
                'ip_address' => $this->getIp(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]);

            // Membuat Absensi Mahasiswa
            $data_mahasiswa = Mahasiswa::where('kelas_id', $request->kelas_id)->get();

            // mahasiswa ekstensi
            $data_mhs_ekstensi = KrsMahasiswaEkstensi::where('tahun_ajaran_id', $request->id_tahun_ajaran)
            ->where('semester_id', $request->id_semester)->where('id_dosen', $dosen->id)
            ->where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)
            ->get();

            foreach($data_mhs_ekstensi as $mhs) {
                AbsensiMahasiswa::create([
                    'id_tahun_ajaran' => $request->id_tahun_ajaran,
                    'id_semester' => $request->id_semester,
                    'id_prodi' => $request->id_prodi,
                    'id_dosen' => $dosen->id,
                    'id_mahasiswa' => $mhs->mahasiswa_id,
                    'mapel_id' => $request->mapel_id,
                    'hari_id' => $request->hari_id,
                    'kelas_id' => $request->kelas_id,
                    'waktu_id' => $request->waktu_id,
                    'tanggal_masuk' => $date,
                    'status' => 'Alpha',
                    'pertemuan_ke' => $pertemuan,
                    'id_jadwal' => $id_jadwal->id
                ]);
            }


            foreach ($data_mahasiswa as $mahasiswa) {
                AbsensiMahasiswa::create([
                    'id_tahun_ajaran' => $request->id_tahun_ajaran,
                    'id_semester' => $request->id_semester,
                    'id_prodi' => $request->id_prodi,
                    'id_dosen' => $dosen->id,
                    'id_mahasiswa' => $mahasiswa->id,
                    'mapel_id' => $request->mapel_id,
                    'hari_id' => $request->hari_id,
                    'kelas_id' => $request->kelas_id,
                    'waktu_id' => $request->waktu_id,
                    'tanggal_masuk' => $date,
                    'status' => 'Alpha',
                    'pertemuan_ke' => $pertemuan,
                    'id_jadwal' => $id_jadwal->id
                ]);
            }


            return redirect()->back()->with([
                'success' => 'Berhasil absen masuk'
            ]);
            // }
        }
    }

    public function dosenAbsenPenggantiKeluar(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari_id' => 'required',
        ]);
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $absensi_dosen_count = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)
            ->where('tanggal_masuk', $date)
            ->where('waktu_id', $request->waktu_id)->count();

        $absensi_dosen = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)
            ->where('tanggal_masuk', $date)
            ->where('waktu_id', $request->waktu_id)->first();

        if ($absensi_dosen_count > 0) {
            $absensi_dosen->update([
                'jam_keluar' => $time
            ]);
            return redirect()->back()->with([
                'success' => 'Berhasil absen keluar'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Belum absen'
            ]);
        }
    }

    public function dosenAbsenKeluar(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari_id' => 'required',
        ]);
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $absensi_dosen_count = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)
            ->where('tanggal_masuk', $date)
            ->where('waktu_id', $request->waktu_id)->count();

        $absensi_dosen = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('kelas_id', $request->kelas_id)
            ->where('tanggal_masuk', $date)
            ->where('waktu_id', $request->waktu_id)->first();

        if ($absensi_dosen_count > 0) {
            $absensi_dosen->update([
                'jam_keluar' => $time
            ]);
            return redirect()->back()->with([
                'success' => 'Berhasil absen keluar'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Belum absen'
            ]);
        }
    }

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function siswa(Request $request)
    {
        if (Gate::denies('view-absensi-mahasiswa')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_kelas = Kelas::all();
        $absensi_siswa = AbsensiSiswa::where('tanggal_absen', Carbon::today()->toDateString())->get();
        $absensi_siswa_tanggal = AbsensiSiswa::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        $kelas_id = $request->kelas_id;

        if (!empty($request->tanggal_absen) || !empty($request->kelas_id)) {
            $absensi_siswa_tanggal = $absensi_siswa_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
            $kelas_id = $request->kelas_id;
        }



        return view('guru.absensisiswa.index', [
            'data_kelas' => $data_kelas,
            'absensi_siswas' => $absensi_siswa,
            'absensi_siswa_t' => $absensi_siswa_tanggal,
            'tanggal_absen' => $tanggal_absens,
            'kelas_id' => $kelas_id
        ])->with('absensi');
    }

    public function siswaAbsensi(Request $request)
    {
        if (Gate::denies('view-absensi-mahasiswa')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_kelas = Kelas::all();
        $absensi_siswa = AbsensiSiswa::where('tanggal_absen', Carbon::today()->toDateString())->get();
        $absensi_siswa_tanggal = AbsensiSiswa::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        $kelas_id = $request->kelas_id;


        if (!empty($request->tanggal_absen) || !empty($request->kelas_id)) {
            $absensi_siswa_tanggal = $absensi_siswa_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
            $kelas_id = $request->kelas_id;
        }



        return view('guru.absensisiswa.index', [
            'data_kelas' => $data_kelas,
            'absensi_siswas' => $absensi_siswa,
            'absensi_siswa_t' => $absensi_siswa_tanggal,
            'tanggal_absen' => $tanggal_absens,
            'kelas_id' => $kelas_id

        ])->with('absensi');
    }

    public function siswaLaporan(Request $request)
    {
        $file_name = str_replace('-', '_', $request->tanggal_absen);
        return Excel::download(new AbsensiSiswaExport($request->tanggal_absen), $file_name . '_absensimahasiswa.xlsx');
    }

    public function mahasiswaAbsen($id_jadwal)
    {

       // $dosen = Mahasiswa::where('kelas_id', $kelas_id);
       // $data_absensi_dosen = AbsensiMahasiswa::where('kelas_id', $kelas_id)->get();

        return view('guru.absensisiswa.index', [
          //  'data_absensi_dosen' => $data_absensi_dosen

            'id_jadwal'=>  $id_jadwal
        ]);
    }

    public function get_kelas_id($id,Request $request)
    {

        //$id = $request->input('id');
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));

        $jadwal = Jadwal::find($id);
        $date = date("Y-m-d");

        $data = AbsensiMahasiswa::leftjoin('mahasiswa','absensi_mahasiswas.id_mahasiswa','mahasiswa.id');

        $data = $data->select('absensi_mahasiswas.*','mahasiswa.nama_mahasiswa as nama_mahasiswa');

        $data = $data
                ->where('absensi_mahasiswas.id_tahun_ajaran', $jadwal->tahun_ajaran_id)
                ->where('absensi_mahasiswas.id_semester', $jadwal->semester_id)
                ->where('absensi_mahasiswas.id_dosen', $jadwal->id_dosen)
                ->where('absensi_mahasiswas.mapel_id', $jadwal->mapel_id)
                // ->where('absensi_mahasiswas.waktu_id', $jadwal->waktu_id)
                // ->where('absensi_mahasiswas.hari_id', $jadwal->hari_id)
                ->where('absensi_mahasiswas.kelas_id', $jadwal->kelas_id)
                ->where('absensi_mahasiswas.tanggal_masuk', $date)
                ;


        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('nama_mahasiswa'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('pertemuan_ke'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('status'), 'like', '%' . $search_filter . '%');
            });
        }
        $data = $data->orderByRaw($order)->paginate($limit);
        
        //$data = $data->find($id);


        

        if ($data) {
            $response = [
                'message'        => 'List Mahasiswa Detail',
                'data'         => $data
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message'        => 'Not Found'
            ];

            return response()->json($response, 404);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }

     public function absensiMahasiswaMasuk($id, Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'id_dosen' => 'required'
        // ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        //$mahasiswa = Mahasiswa::where('user_id', $id);
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        $absensi_mahasiswa = AbsensiMahasiswa::where('id', $id)->first();

        $absensi_mahasiswa->update([
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => $new_arr[0]['geoplugin_longitude'],
            'lat' => $new_arr[0]['geoplugin_latitude'],
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);
        return redirect()->back();


        // }
    }

    public function mahasiswaAbsenPengganti($id_jadwal)
    {

       // $dosen = Mahasiswa::where('kelas_id', $kelas_id);
       // $data_absensi_dosen = AbsensiMahasiswa::where('kelas_id', $kelas_id)->get();

        return view('guru.absensisiswapengganti.index', [
          //  'data_absensi_dosen' => $data_absensi_dosen

            'id_jadwal'=>  $id_jadwal
        ]);
    }


     public function absensiPenggantiMahasiswaMasuk($id, Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'id_dosen' => 'required'
        // ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        //$mahasiswa = Mahasiswa::where('user_id', $id);
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        $absensi_mahasiswa = AbsensiMahasiswa::where('id', $id)->first();

        $absensi_mahasiswa->update([
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => $new_arr[0]['geoplugin_longitude'],
            'lat' => $new_arr[0]['geoplugin_latitude'],
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);
        return redirect()->back();


        // }
    }



        public function kelas()
    {
        try {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $jadwal = Jadwal::where('tahun_ajaran_id', $tahun->id)
            ->where('semester_id', $semester->id)
            ->where('id_dosen', $dosen->id)
            ->select('kelas_id')
            ->get();
        $data_kelas = Kelas::whereIn('id', $jadwal)->get();

        return view('guru.absensisiswa.kelas',[
            'data_kelas' => $data_kelas
        ]);
        } catch (\Throwable $th) {
            return redirect('/')->with([
                'error' => 'Ada kesalahan.'
            ]);
        }
    }

    public function mahasiswa(Request $request, $kelas_id)
    {
        $data_mahasiswa = Mahasiswa::where('kelas_id', $kelas_id)->select('id')->get();

        $data_absensi_mahasiswa = AbsensiMahasiswa::where('tanggal_masuk', Carbon::today()->toDateString())->whereIn('id_mahasiswa', $data_mahasiswa)->get();

        $absensi_dosen = AbsensiDosen::where('tanggal_masuk', Carbon::today()->toDateString())->get();
        $absensi_dosen_tanggal = AbsensiDosen::orderBy('tanggal_masuk', 'desc');
        $tanggal_absens = '';

        if (!empty($request->tanggal_absens)) {
            $absensi_dosen_tanggal = $absensi_dosen_tanggal->where('tanggal_masuk', Carbon::parse($request->tanggal_absen))->get();
        }
        return view('guru.absensisiswa.absensi', [
            'data_absensi_mahasiswa' => $data_absensi_mahasiswa,
            'tanggal_absen' => $tanggal_absens,
            'kelas_id' => $kelas_id
        ]);
    }

    public function mahasiswaAbsensi(Request $request, $kelas_id)
    {

        $data_mahasiswa = Mahasiswa::where('kelas_id', $kelas_id)->select('id')->get();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $data_absensi_mahasiswa = AbsensiMahasiswa::
        where('id_dosen', $dosen->id)
        ->whereIn('id_mahasiswa', $data_mahasiswa)
        ->get();

        $absensi_mahasiswa = AbsensiMahasiswa::
        where('id_dosen', $dosen->id)
        ->whereIn('id_mahasiswa', $data_mahasiswa)
        ->where('tanggal_masuk', Carbon::today())->get();
        $absensi_mahasiswa_tanggal = AbsensiMahasiswa::orderBy('tanggal_masuk', 'desc');
        //$tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_mahasiswa_tanggal = $absensi_mahasiswa_tanggal->
            where('id_dosen', $dosen->id)->whereIn('id_mahasiswa', $data_mahasiswa)
            ->where('tanggal_masuk', Carbon::parse($request->tanggal_absen))->get();
        }

        return view('guru.absensisiswa.absensi', [
            'absensi_mahasiswa' => $absensi_mahasiswa,
            'absensi_mahasiswa_tanggal' => $absensi_mahasiswa_tanggal,
            'tanggal_absen' => $request->tanggal_absen,
            'kelas_id' => $kelas_id
        ]);
    }

      public function mahasiswaLaporan(Request $request)
    {
        $file_name = str_replace('-', '_', $request->tanggal_absen);
        return Excel::download(new AbsensiMahasiswaExport($request->tanggal_absen), $file_name . '_absensimahasiswa.xlsx');
    }



    public function dosenAbsenSPMasuk(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            //'kelas_id' => 'required',
            'hari_id' => 'required',
        ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $dosen = Dosen::where('user_id', Auth::id())->first();
        // $waktu = Waktu::find($request->waktu_id);
        // $str_time = strtotime($time);
        // $str_jam_masuk = strtotime($waktu->jam_masuk);
        // $selisih_waktu = $str_time - $str_jam_masuk;
        // $jam    = floor($selisih_waktu / (60 * 60));
        // $menit    = $selisih_waktu - $jam * (60 * 60);

        $data_terlambat = 15 * 60;
        if ($dosen == null) {
            return abort(403, 'Permission Denied');
        }
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));


        $absensi_dosen = AbsensiDosenSP::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)
            ->count();

        $id_jadwal = JadwalSP::where('tahun_ajaran_id', $request->id_tahun_ajaran)
            ->where('semester_id', $request->id_semester)->where('prodi_id', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)->where('waktu_id', $request->waktu_id)->first();

        if (($absensi_dosen > 0)) {
            return redirect()->back()->with([
                'error2' => 'Sudah absen masuk'
            ]);
        } else {
            // dd($menit);
            // if ($menit - $data_terlambat > 15) {
            //     return redirect()->back()->with([
            //         'error' => 'Sudah melewati batas waktu, silahkan hubungi admin akademik'
            //     ]);
            // } else {
            // hitung pertemuan
            $pertemuan = AbsensiDosenSP::where('id_tahun_ajaran', $request->id_tahun_ajaran)
                ->where('id_semester', $request->id_semester)->where('id_dosen', $dosen->id)
                ->where('hari_id', $request->hari_id)->where('mapel_id', $request->mapel_id)
                ->where('waktu_id', $request->waktu_id)
                ->orderBy('pertemuan_ke', 'desc')->value('pertemuan_ke');
            AbsensiDosenSP::create([
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_semester' => $request->id_semester,
                'id_prodi' => $request->id_prodi,
                'id_dosen' => $dosen->id,
                'mapel_id' => $request->mapel_id,
                'hari_id' => $request->hari_id,
                //'kelas_id' => $request->kelas_id,
                'waktu_id' => $request->waktu_id,

                'pertemuan_ke' => ++$pertemuan ?? '1',
                'tanggal_masuk' => $date,
                'jam_masuk' => $time,
                'status' => 'Hadir',
                'long' => $new_arr[0]['geoplugin_longitude'],
                'lat' => $new_arr[0]['geoplugin_latitude'],
                'ip_address' => $this->getIp(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]);

            // Membuat Absensi Mahasiswa
            $data_mahasiswa = DataSP::where('mapel_id', $request->mapel_id)->get();
            foreach ($data_mahasiswa as $mahasiswa) {
                AbsensiMahasiswaSP::create([
                    'id_tahun_ajaran' => $request->id_tahun_ajaran,
                    'id_semester' => $request->id_semester,
                    'id_prodi' => $request->id_prodi,
                    'id_dosen' => $dosen->id,
                    'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                    'mapel_id' => $request->mapel_id,
                    'hari_id' => $request->hari_id,
                    //'kelas_id' => $request->kelas_id,
                    'id_jadwal' => $id_jadwal->id,
                    'waktu_id' => $request->waktu_id,
                    'tanggal_masuk' => $date,
                    'status' => 'Alpha',
                    'pertemuan_ke' => $pertemuan
                ]);
            }


            return redirect()->back()->with([
                'success2' => 'Berhasil absen masuk'
            ]);
            // }
        }
    }


    public function dosenAbsenSPKeluar(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            //'kelas_id' => 'required',
            'hari_id' => 'required',
        ]);
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $absensi_dosen_count = AbsensiDosenSP::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)
            ->where('waktu_id', $request->waktu_id)->count();

        $absensi_dosen = AbsensiDosenSP::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)->where('mapel_id', $request->mapel_id)
            ->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)
            ->where('waktu_id', $request->waktu_id)->first();

        if ($absensi_dosen_count > 0) {
            $absensi_dosen->update([
                'jam_keluar' => $time
            ]);
            return redirect()->back()->with([
                'success2' => 'Berhasil absen keluar'
            ]);
        } else {
            return redirect()->back()->with([
                'error2' => 'Belum absen'
            ]);
        }
    }

     public function mahasiswaAbsenSP($id_jadwal)
    {

       // $dosen = Mahasiswa::where('kelas_id', $kelas_id);
       // $data_absensi_dosen = AbsensiMahasiswa::where('kelas_id', $kelas_id)->get();

        return view('guru.absensisiswasp.index', [
          //  'data_absensi_dosen' => $data_absensi_dosen

            'id_jadwal'=>  $id_jadwal
        ]);
    }

    public function get_mapel_id($id,Request $request)
    {

        //$id = $request->input('id');
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));
        

        $data = AbsensiMahasiswaSP::leftjoin('mahasiswa','absensi_mahasiswa_sp.id_mahasiswa','mahasiswa.id');

        $data = $data->select('absensi_mahasiswa_sp.*','mahasiswa.nama_mahasiswa as nama_mahasiswa');

        $data = $data->where('absensi_mahasiswa_sp.id_jadwal', $id);


        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('nama_mahasiswa'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('pertemuan_ke'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('status'), 'like', '%' . $search_filter . '%');
            });
        }
        $data = $data->orderByRaw($order)->paginate($limit);
        
        //$data = $data->find($id);


        

        if ($data) {
            $response = [
                'message'        => 'List Mahasiswa Detail',
                'data'         => $data
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message'        => 'Not Found'
            ];

            return response()->json($response, 404);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }

     public function absensiSPMahasiswaMasuk($id, Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'id_dosen' => 'required'
        // ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        //$mahasiswa = Mahasiswa::where('user_id', $id);
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        $absensi_mahasiswa = AbsensiMahasiswaSP::where('id', $id)->first();

        $absensi_mahasiswa->update([
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => $new_arr[0]['geoplugin_longitude'],
            'lat' => $new_arr[0]['geoplugin_latitude'],
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);
        return redirect()->back();


        // }
    }   
}