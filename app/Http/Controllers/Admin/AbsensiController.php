<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiGuru;
use App\Models\AbsensiDosen;
use App\Models\AbsensiPegawai;
use App\Models\AbsensiSiswa;
use App\Models\Kelas;
use Carbon\Carbon;
use App\Models\Prodi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiPegawaiExport;
use App\Exports\AbsensiSiswaExport;
use App\Exports\AbsensiGuruExport;
use App\Exports\AbsensiDosenExport;
use App\Exports\AbsensiMahasiswaExport;
use App\Exports\RekapAbsensiDosenExport;
use Illuminate\Support\Facades\DB;
use App\Models\AbsensiMahasiswa;
use App\Models\Mahasiswa;

Carbon::setLocale('id');

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function guru(Request $request)
    {

        $absensi_guru = AbsensiGuru::where('tanggal_absen', Carbon::today()->toDateString())->get();
        $absensi_guru_tanggal = AbsensiGuru::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_guru_tanggal = $absensi_guru_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
        }

        return view('admin.absensiguru.index', [
            'absensi_gurus' => $absensi_guru,
            'absensi_gurus_t' => $absensi_guru_tanggal,
            'tanggal_absen' => $tanggal_absens

        ])->with('absensi');
    }

    public function dosen(Request $request)
    {
        $date = date("Y-m-d");
        $absensi_dosen = AbsensiDosen::where('tanggal_masuk', Carbon::today()->toDateString())->get();
        $absensi_dosen_tanggal = AbsensiDosen::orderBy('tanggal_masuk', 'desc');
        $tanggal_absens = '';

        if (!empty($request->tanggal_absens)) {
            $absensi_dosen_tanggal = $absensi_dosen_tanggal->where('tanggal_masuk', Carbon::parse($request->waktu_masuk)->toDateString())->get();
        }
        return view('admin.absensidosen.index', [
            'absensi_dosen' => $absensi_dosen,
            'absensi_dosen_tanggal' => $absensi_dosen_tanggal,
            'tanggal_absen' => $tanggal_absens
        ]);
    }

    public function guruAbsensi(Request $request)
    {
        $absensi_guru = AbsensiGuru::where('tanggal_absen', Carbon::today()->toDateString())->get();
        $absensi_guru_tanggal = AbsensiGuru::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = "";

        if (!empty($request->tanggal_absen)) {
            $absensi_guru_tanggal = $absensi_guru_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
        }

        return view('admin.absensiguru.index', [
            'absensi_gurus' => $absensi_guru,
            'absensi_gurus_t' => $absensi_guru_tanggal,
            'tanggal_absen' => $tanggal_absens

        ])->with('absensi');
    }

    public function dosenAbsensi(Request $request)
    {
        $absensi_dosen = AbsensiDosen::where('tanggal_masuk', Carbon::today())->get();
        $absensi_dosen_tanggal = AbsensiDosen::orderBy('tanggal_masuk', 'desc');
        //  $tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_dosen_tanggal = $absensi_dosen_tanggal->where('tanggal_masuk', Carbon::parse($request->tanggal_absen))->get();
        }

        return view('admin.absensidosen.index', [
            'absensi_dosen' => $absensi_dosen,
            'absensi_dosen_tanggal' => $absensi_dosen_tanggal,
            'tanggal_absen' => $request->tanggal_absen
        ]);
    }

    public function cariRekapDosen(Request $request)
    {
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required'
        ]);

        $start = $request->start;
        $end = $request->end;

        $data_absensi = AbsensiDosen::whereBetween('tanggal_masuk', [
            Carbon::parse($start)->toDateString(),
            Carbon::parse($end)->toDateString()
        ])
        ->select(DB::raw('count(*) as total, id_dosen, mapel_id, kelas_id'))
        ->groupBy(['id_dosen', 'mapel_id', 'kelas_id'])
        ->with(['dosen','mapel', 'kelas'])
        ->get();

        $absensi_dosen = AbsensiDosen::where('tanggal_masuk', Carbon::today())->get();
        $absensi_dosen_tanggal = AbsensiDosen::orderBy('tanggal_masuk', 'desc');
        //  $tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_dosen_tanggal = $absensi_dosen_tanggal->where('tanggal_masuk', Carbon::parse($request->tanggal_absen))->get();
        }

        return view('admin.absensidosen.index', [
            'data_absensi' => $data_absensi,
            'absensi_dosen' => $absensi_dosen,
            'absensi_dosen_tanggal' => $absensi_dosen_tanggal,
            'tanggal_absen' => $request->tanggal_absen,
            'start' => $start,
            'end' => $end
        ]);
    }


    public function dosenLaporan(Request $request)
    {
        $file_name = str_replace('-', '_', $request->tanggal_absen);
        return Excel::download(new AbsensiDosenExport($request->tanggal_absen), $file_name . '_absensi_dosen.xls');
    }

    public function rekapAbsensiDosen(Request $request)
    {

        try {
            $data = explode('-', $request->start);
            $file_name = str_replace('-', '_', $data[0] . '-' . $data[1]);
            return Excel::download(new RekapAbsensiDosenExport($request->start, $request->end), $file_name . '_rekap_absensi_dosen.xls');
        } catch (\Exception $th) {
            return redirect()->route('admin.absensi.dosen')->with([
                'error' => 'Silahkan coba lagi!'
            ]);
        }
    }

    public function guruLaporan(Request $request)
    {
        $file_name = str_replace('-', '_', $request->tanggal_absen);
        return Excel::download(new AbsensiGuruExport($request->tanggal_absen), $file_name . '_absensiguru.xlsx');
    }

    public function mahasiswaLaporan(Request $request)
    {
        $file_name = str_replace('-', '_', $request->tanggal_absen);
        return Excel::download(new AbsensiMahasiswaExport($request->tanggal_absen), $file_name . '_absensimahasiswa.xlsx');
    }


    public function prodi()
    {
        $data_prodi = Prodi::all();

        return view('admin.absensimahasiswa.prodi', [
            'data_prodi' => $data_prodi
        ]);
    }

    public function mahasiswa(Request $request, $id_prodi)
    {
        $data_mahasiswa = Mahasiswa::where('id_prodi', $id_prodi)->select('id')->get();

        $data_absensi_mahasiswa = AbsensiMahasiswa::where('tanggal_masuk', Carbon::today()->toDateString())->whereIn('id_mahasiswa', $data_mahasiswa)->get();

        $absensi_dosen = AbsensiDosen::where('tanggal_masuk', Carbon::today()->toDateString())->get();
        $absensi_dosen_tanggal = AbsensiDosen::orderBy('tanggal_masuk', 'desc');
        $tanggal_absens = '';

        if (!empty($request->tanggal_absens)) {
            $absensi_dosen_tanggal = $absensi_dosen_tanggal->where('tanggal_masuk', Carbon::parse($request->tanggal_absen))->get();
        }
        return view('admin.absensimahasiswa.index', [
            'data_absensi_mahasiswa' => $data_absensi_mahasiswa,
            'tanggal_absen' => $tanggal_absens,
            'id_prodi' => $id_prodi
        ]);
    }

    public function mahasiswaAbsensi(Request $request, $id_prodi)
    {
        $data_mahasiswa = Mahasiswa::where('id_prodi', $id_prodi)->select('id')->get();

        $data_absensi_mahasiswa = AbsensiMahasiswa::whereIn('id_mahasiswa', $data_mahasiswa)->get();

        $absensi_mahasiswa = AbsensiMahasiswa::where('tanggal_masuk', Carbon::today())->get();
        $absensi_mahasiswa_tanggal = AbsensiMahasiswa::orderBy('tanggal_masuk', 'desc');
        //$tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_mahasiswa_tanggal = $absensi_mahasiswa_tanggal->where('tanggal_masuk', Carbon::parse($request->tanggal_absen))->get();
        }

        return view('admin.absensimahasiswa.index', [
            'absensi_mahasiswa' => $absensi_mahasiswa,
            'absensi_mahasiswa_tanggal' => $absensi_mahasiswa_tanggal,
            'tanggal_absen' => $request->tanggal_absen,
            'id_prodi' => $id_prodi
        ]);
    }


    public function pegawai(Request $request)
    {
        $absensi_pegawai = AbsensiPegawai::where('tanggal_absen', Carbon::today()->toDateString())->get();

        $absensi_pegawai_tanggal = AbsensiPegawai::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_pegawai_tanggal = $absensi_pegawai_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
        }

        return view('admin.absensipegawai.index', [

            'absensi_pegawai' => $absensi_pegawai,
            'absensi_pegawai_t' => $absensi_pegawai_tanggal,
            'tanggal_absen' => $tanggal_absens
        ])->with('absensi');
    }

    public function pegawaiAbsensi(Request $request)
    {

        $absensi_pegawai = AbsensiPegawai::where('tanggal_absen', Carbon::today()->toDateString())->get();

        $absensi_pegawai_tanggal = AbsensiPegawai::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        if (!empty($request->tanggal_absen)) {
            $absensi_pegawai_tanggal = $absensi_pegawai_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
        }

        return view('admin.absensipegawai.index', [

            'absensi_pegawai' => $absensi_pegawai,
            'absensi_pegawai_t' => $absensi_pegawai_tanggal,
            'tanggal_absen' => $tanggal_absens
        ])->with('absensi');
    }

    public function pegawaiLaporan(Request $request)
    {
        $file_name = str_replace('-', '_', $request->tanggal_absen);
        return Excel::download(new AbsensiPegawaiExport($request->tanggal_absen), $file_name . '_absensipegawai.xlsx');
    }

    public function siswa(Request $request)
    {
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



        return view('admin.absensisiswa.index', [
            'data_kelas' => $data_kelas,
            'absensi_siswas' => $absensi_siswa,
            'absensi_siswa_t' => $absensi_siswa_tanggal,
            'tanggal_absen' => $tanggal_absens,
            'kelas_id' => $kelas_id
        ])->with('absensi');
    }

    public function siswaAbsensi(Request $request)
    {
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



        return view('admin.absensisiswa.index', [
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
        return Excel::download(new AbsensiSiswaExport($request->tanggal_absen), $file_name . '_absensisiswa.xlsx');
    }
}
