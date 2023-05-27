<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Absensi;
use App\Models\AbsensiGuru;
use App\Models\AbsensiDosen;
use App\Models\AbsensiMahasiswa;
use App\Models\AbsensiPegawai;
use App\Models\AbsensiSiswa;
use App\Models\DataOrangTua;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Pegawai;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\Waktu;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\KrsMahasiswaEkstensi;

class AbsensiController extends BaseController
{
    //
    /**
     * Untuk Siswa
     * 
     */
    public function getAbsensiSiswaPribadi(Request $request)
    {
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_absensi = AbsensiSiswa::where('siswa_id', $siswa->id)
            ->where('tanggal_absen', '>=', Carbon::parse($request->tanggal_awal)->toDateString())
            ->where('tanggal_absen', '<=', Carbon::parse($request->tanggal_akhir)->toDateString())
            ->get();
        $data['data'] = $data_absensi;
        $data['Hadir'] = $data_absensi->where('keterangan', 'Hadir')->count();
        $data['Sakit'] = $data_absensi->where('keterangan', 'Sakit')->count();
        $data['Izin'] = $data_absensi->where('keterangan', 'Izin')->count();
        $data['Alpha'] = $data_absensi->where('keterangan', 'Alpha')->count();

        return response()->json($data);
    }

    /**
     * Untuk Orang Tua
     */
    public function ortuGetAbsensiSiswaPribadi(Request $request)
    {
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();
        $data_absensi = AbsensiSiswa::where('siswa_id', $ortu->siswa_id)
            ->where('tanggal_absen', '>=', Carbon::parse($request->tanggal_awal)->toDateString())
            ->where('tanggal_absen', '<=', Carbon::parse($request->tanggal_akhir)->toDateString())
            ->get();

        $data['data'] = $data_absensi;
        $data['Hadir'] = $data_absensi->where('keterangan', 'Hadir')->count();
        $data['Sakit'] = $data_absensi->where('keterangan', 'Sakit')->count();
        $data['Izin'] = $data_absensi->where('keterangan', 'Izin')->count();
        $data['Alpha'] = $data_absensi->where('keterangan', 'Alpha')->count();

        return response()->json($data);
    }

    /**
     * 
     * Untuk Guru 
     * 
     */
    public function getAbsensiGuru(Request $request)
    {
        $guru = Dosen::where('user_id', Auth::id())->first();
        $data_absensi = AbsensiDosen::where('id_dosen', $guru->id)
            ->where('tanggal_masuk', '>=', Carbon::parse($request->tanggal_awal)->toDateString())
            ->where('tanggal_masuk', '<=', Carbon::parse($request->tanggal_akhir)->toDateString())
            ->get();

        $data['data'] = $data_absensi;
        $data['Hadir'] = $data_absensi->where('status', 'Hadir')->count();
        $data['Sakit'] = $data_absensi->where('status', 'Sakit')->count();
        $data['Izin'] = $data_absensi->where('status', 'Izin')->count();
        $data['Alpha'] = $data_absensi->where('status', 'Alpha')->count();

        return response()->json($data);
    }

    /**
     * Post absensi siswa
     * 
     */
    public function absensiSiswa(Request $request)
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $absen = new AbsensiSiswa;

        // absen masuk
        if (isset($request->btnIn)) {
            // cek duplikat
            $cek_duplikat = $absen->where(['tanggal_absen' => $date, 'siswa_id' => $siswa->id])
                ->count();
            if ($cek_duplikat > 0) {
                return response()->json($cek_duplikat);
            }
            $new_absen = $absen->create([
                'siswa_id' => $siswa->id,
                'tanggal_absen' => $date,
                'jam_masuk' => $time,
                'keterangan' => 'Hadir'
            ]);
            return response()->json($new_absen);
        }
        // absen pulang
        elseif (isset($request->btnOut)) {

            $update_absen = $absen->where(['tanggal_absen' => $date, 'siswa_id' => $siswa->id])
                ->update([
                    'jam_pulang' => $time,
                    'keterangan' => 'Hadir'
                ]);
            $update_absen_ = $update_absen;
            return response()->json($update_absen_);
        }

        return response()->json($absen);
    }

    /**
     * Post absensi guru
     * 
     */
    public function absensiGuru(Request $request)
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $absen = new AbsensiGuru;

        // absen masuk
        if (isset($request->btnIn)) {
            // cek duplikat
            $cek_duplikat = $absen->where(['tanggal_absen' => $date, 'guru_id' => $guru->id])
                ->count();
            if ($cek_duplikat > 0) {
                return response()->json($cek_duplikat);
            }
            $new_absen = $absen->create([
                'guru_id' => $guru->id,
                'tanggal_absen' => $date,
                'jam_masuk' => $time,
                'keterangan' => 'Hadir'
            ]);
            return response()->json($new_absen);
        }
        // absen pulang
        elseif (isset($request->btnOut)) {
            $update_absen = $absen->where(['tanggal_absen' => $date, 'guru_id' => $guru->id])
                ->update([
                    'jam_pulang' => $time,
                    'keterangan' => 'Hadir'
                ]);
            return response()->json($update_absen);
        }

        return response()->json($absen);
    }

    /**
     * Guru
     * List kelas
     * 
     */
    public function listKelas()
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $guru = Guru::where('user_id', '=', Auth::id())->first();
        $data_jadwal = Jadwal::where('guru_id', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->select('kelas_id')
            ->with('kelas')
            ->distinct()
            ->get();
        return response()->json($data_jadwal);
    }

    /**
     * Guru
     * Absensi Kelas yang diajar
     * 
     */
    public function absensiKelas(Request $request, $kelas_id)
    {
        $siswa = Siswa::leftjoin('absensi_siswas', 'siswa.id', '=', 'absensi_siswas.siswa_id')
            ->select('absensi_siswas.id', 'siswa.nama_depan', 'siswa.nama_belakang',  'absensi_siswas.jam_masuk', 'absensi_siswas.jam_pulang', 'absensi_siswas.keterangan')
            ->where('siswa.kelas_id', '=', $kelas_id)
            ->where('absensi_siswas.tanggal_absen', $request->tanggal_absen)
            ->get();

        return response()->json($siswa);
    }

    /**
     * Post absensi perpus
     * 
     */
    public function absensiPerpus(Request $request)
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $pegawai = Pegawai::where('user_id', Auth::id())->first();

        if ($guru != null) {
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $absen = new AbsensiGuru;

            // absen masuk
            if (isset($request->btnIn)) {
                // cek duplikat
                $cek_duplikat = $absen->where(['tanggal_absen' => $date, 'guru_id' => $guru->id])
                    ->count();
                if ($cek_duplikat > 0) {
                    return response()->json($cek_duplikat);
                }
                $new_absen = $absen->create([
                    'guru_id' => $guru->id,
                    'tanggal_absen' => $date,
                    'jam_masuk' => $time,
                    'keterangan' => 'Hadir'
                ]);
                return response()->json($new_absen);
            }
            // absen pulang
            elseif (isset($request->btnOut)) {
                $update_absen = $absen->where(['tanggal_absen' => $date, 'guru_id' => $guru->id])
                    ->update([
                        'jam_pulang' => $time,
                        'keterangan' => 'Hadir'
                    ]);
                return response()->json($update_absen);
            }

            return response()->json($absen);
        } elseif ($pegawai != null) {
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $absen = new AbsensiPegawai();

            // absen masuk
            if (isset($request->btnIn)) {
                // cek duplikat
                $cek_duplikat = $absen->where(['tanggal_absen' => $date, 'pegawai_id' => $pegawai->id])
                    ->count();
                if ($cek_duplikat > 0) {
                    return response()->json($cek_duplikat);
                }
                $new_absen = $absen->create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal_absen' => $date,
                    'jam_masuk' => $time,
                    'keterangan' => 'Hadir'
                ]);
                return response()->json($new_absen);
            }
            // absen pulang
            elseif (isset($request->btnOut)) {
                $update_absen = $absen->where(['tanggal_absen' => $date, 'pegawai_id' => $pegawai->id])
                    ->update([
                        'jam_pulang' => $time,
                        'keterangan' => 'Hadir'
                    ]);
                return response()->json($update_absen);
            }

            return response()->json($absen);
        }
    }

    /**
     * 
     * Untuk Perpus 
     * 
     */
    public function getAbsensiPerpus(Request $request)
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $pegawai = Pegawai::where('user_id', Auth::id())->first();
        if ($guru != null) {
            $data_absensi = AbsensiGuru::where('guru_id', $guru->id)
                ->where('tanggal_absen', '>=', Carbon::parse($request->tanggal_awal)->toDateString())
                ->where('tanggal_absen', '<=', Carbon::parse($request->tanggal_akhir)->toDateString())
                ->get();

            $data['data'] = $data_absensi;
            $data['Hadir'] = $data_absensi->where('keterangan', 'Hadir')->count();
            $data['Sakit'] = $data_absensi->where('keterangan', 'Sakit')->count();
            $data['Izin'] = $data_absensi->where('keterangan', 'Izin')->count();
            $data['Alpha'] = $data_absensi->where('keterangan', 'Alpha')->count();

            return response()->json($data);
        } elseif ($pegawai != null) {
            $data_absensi = AbsensiPegawai::where('pegawai_id', $pegawai->id)
                ->where('tanggal_absen', '>=', Carbon::parse($request->tanggal_awal)->toDateString())
                ->where('tanggal_absen', '<=', Carbon::parse($request->tanggal_akhir)->toDateString())
                ->get();

            $data['data'] = $data_absensi;
            $data['Hadir'] = $data_absensi->where('keterangan', 'Hadir')->count();
            $data['Sakit'] = $data_absensi->where('keterangan', 'Sakit')->count();
            $data['Izin'] = $data_absensi->where('keterangan', 'Izin')->count();
            $data['Alpha'] = $data_absensi->where('keterangan', 'Alpha')->count();

            return response()->json($data);
        }
    }

    public function getListAbsensiDosen(Request $request)
    {

        $date = date("Y-m-d");
        $hari = "";
        switch (date('w', strtotime($date))) {

            case 1:
                $hari = "Senin";
                break;
            case 2:
                $hari = "Selasa";
                break;
            case 3:
                $hari = "Rabu";
                break;
            case 4:
                $hari = "Kamis";
                break;
            case 5:
                $hari = "Jumat";
                break;
            case 6:
                $hari = "Sabtu";
                break;
            default:
                $hari = "Senin";
        }

        $hari_id = Hari::where('hari', $hari)->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $guru = Dosen::where('user_id', Auth::id())->first();
        $data_jadwal = Jadwal::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('hari_id', $hari_id->id)
            // ->groupBy('hari_id')
            ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
            ->get();

        return response()->json($data_jadwal);
    }

    public function dosenAbsenMasuk(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'pertemuan_ke' => 'required',
        // ]);
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
        // hitung pertemuan
        $pertemuan = AbsensiDosen::where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)->where('id_dosen', $dosen->id)
            ->where('hari_id', $request->hari_id)->where('mapel_id', $request->mapel_id)
            ->where('kelas_id', $request->kelas_id)->where('waktu_id', $request->waktu_id)
            ->orderBy('pertemuan_ke', 'desc')->value('pertemuan_ke');

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
        if (($absensi_dosen > 0)) {
            return response()->json("Sudah absen masuk");
        } else {
            // dd($menit);
            // if ($menit - $data_terlambat > 15) {
            //     return redirect()->back()->with([
            //         'error' => 'Sudah melewati batas waktu, silahkan hubungi admin akademik'
            //     ]);
            // } else {
            AbsensiDosen::create([
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'id_semester' => $request->id_semester,
                'id_prodi' => $request->id_prodi,
                'id_dosen' => $dosen->id,
                'mapel_id' => $request->mapel_id,
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'waktu_id' => $request->waktu_id,
                'pertemuan_ke' => ++$pertemuan,
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

            foreach ($data_mhs_ekstensi as $mhs) {
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
                    'pertemuan_ke' => $pertemuan
                ]);
            }

            


            return response()->json("Berhasil Absen Masuk");
            // }
        }
    }

    public function dosenAbsenKeluar(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'pertemuan_ke' => 'required',
        // ]);
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
            return response()->json("Berhasil Absen Keluar");
        } else {
            return response()->json("Sudah Absen Keluar");
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

    public function getAllAbsensiMahasiswa()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $data_absensi = AbsensiDosen::where('id_dosen', $dosen->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->with('hari', 'waktu', 'kelas', 'semesters', 'tahunajaran', 'mapel')
            ->get();

        return response()->json($data_absensi);
    }

    public function getAllMahasiswa(Request $request)
    {

        $dosen = Dosen::where('user_id', Auth::id())->first();

        // dd($dosen);

        $data_absensi = AbsensiMahasiswa::where('created_at', $request->tanggal)
            ->where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_semester', $request->id_semester)
            ->where('id_prodi', $request->id_prodi)
            ->where('id_dosen', $dosen->id)
            ->where('mapel_id', $request->mapel_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('hari_id', $request->hari_id)
            ->where('waktu_id', $request->waktu_id)
            ->with('hari', 'waktu', 'kelas', 'semesters', 'tahunajaran', 'mapel', 'mahasiswa')
            ->get();

        return response()->json($data_absensi);
    }


    public function getAbsensiMahasiswa()
    {
        $date = date("Y-m-d");
        $hari = "";
        switch (date('w', strtotime($date))) {

            case 1:
                $hari = "Senin";
                break;
            case 2:
                $hari = "Selasa";
                break;
            case 3:
                $hari = "Rabu";
                break;
            case 4:
                $hari = "Kamis";
                break;
            case 5:
                $hari = "Jumat";
                break;
            case 6:
                $hari = "Sabtu";
                break;
            default:
                $hari = "Senin";
        }

        $hari_id = Hari::where('hari', $hari)->first();
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        $data_absensi = AbsensiMahasiswa::where('kelas_id', $mahasiswa->kelas_id)
            ->where('id_mahasiswa', $mahasiswa->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->where('hari_id', $hari_id->id)
            ->where('tanggal_masuk', date("Y-m-d"))
            ->with('hari', 'waktu', 'kelas', 'semesters', 'tahunajaran', 'mapel', 'mahasiswa')
            ->get();

        return response()->json($data_absensi);
    }

    public function absenMasukMahasiswa(Request $request)
    {
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));


        $absensi_dosen = AbsensiMahasiswa::find($request->id_absensi);

        if (($absensi_dosen->jam_masuk != null)) {
            return response()->json("Sudah Absen Masuk");
        } else {

            $absensi_dosen->update([
                'tanggal_masuk' => $date,
                'jam_masuk' => $time,
                'status' => 'Hadir',
                'long' => $new_arr[0]['geoplugin_longitude'],
                'lat' => $new_arr[0]['geoplugin_latitude'],
                'ip_address' => $this->getIp(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]);


            return response()->json("Berhasil Absen Masuk");
        }
    }

    public function absenKeluarMahasiswa(Request $request)
    {
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));


        $absensi_dosen = AbsensiMahasiswa::find($request->id_absensi);

        if (($absensi_dosen->jam_keluar != null)) {
            return response()->json("Sudah Absen Keluar");
        } else {

            $absensi_dosen->update([
                'tanggal_masuk' => $date,
                'jam_keluar' => $time,
                'status' => 'Hadir',
                'long' => $new_arr[0]['geoplugin_longitude'],
                'lat' => $new_arr[0]['geoplugin_latitude'],
                'ip_address' => $this->getIp(),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]);


            return response()->json("Berhasil Absen Keluar");
        }
    }

    public function getAbsensiDosen(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $data_absensi = AbsensiDosen::where('id_dosen', $dosen->id)
            ->where('tanggal_masuk', '>=', $request->tanggal_awal)
            ->where('tanggal_masuk', '<=', $request->tanggal_akhir)
            ->get();

        // dd($data_absensi);
        $null = $data_absensi->where('status', null)->count();
        $alpha = $data_absensi->where('status', 'Alpha')->count();

        $data['data'] = $data_absensi;
        $data['Hadir'] = $data_absensi->where('status', 'Hadir')->count();
        $data['Sakit'] = $data_absensi->where('status', 'Sakit')->count();
        $data['Izin'] = $data_absensi->where('status', 'Izin')->count();
        $data['Alpha'] = $null + $alpha;

        return response()->json($data);
    }

    public function getAbsensiMahasiswaPribadi(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_absensi = AbsensiMahasiswa::where('id_mahasiswa', $mahasiswa->id)
            ->where('tanggal_masuk', '>=', $request->tanggal_awal)
            ->where('tanggal_masuk', '<=', $request->tanggal_akhir)
            ->get();
        // dd($data_absensi);
        $null = $data_absensi->where('status', null)->count();
        $alpha = $data_absensi->where('status', 'Alpha')->count();

        $data['data'] = $data_absensi;
        $data['Hadir'] = $data_absensi->where('status', 'Hadir')->count();
        $data['Sakit'] = $data_absensi->where('status', 'Sakit')->count();
        $data['Izin'] = $data_absensi->where('status', 'Izin')->count();
        $data['Alpha'] = $null + $alpha;

        return response()->json($data);
    }
}
