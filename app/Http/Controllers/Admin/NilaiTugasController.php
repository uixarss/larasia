<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NilaiTugasRequest;

;

use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Pengampu;
use App\Models\Semester;
use App\Models\TahunAjaranGuruKelas;
use App\Models\NilaiHarian;
use App\Models\Tugas;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\HasilTugas;
use App\Models\NilaiTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NilaiTugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        // dd($tahun_ajaran);
        if ($tahun_ajaran == null || $semester == null) {
            abort(404);
        }

        $mapel = Pengampu::where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->get();
        //all();

        return view('admin.nilaitugas.index', [
            'mapel' => $mapel
        ]);
    }

    public function kelas(Request $request, $mapel_id)
    {

        $data_kelas = Kelas::all();
        $data_mapel = MataPelajaran::all();

        // $data_kelas_mapel = TahunAjaranGuruKelas::all();

        // $tahun_ajaran = TahunAjaran::
        //     // where('status', true)
        //     where('start_date', '>', now())
        //     ->orWhere('end_date', '<', now())
        //     ->first();

        // $data_kelas_mapel = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
        //     ->get();

        // $data_siswa = Siswa::where('kelas_id', $data_kelas_mapel->kelas_id)->get();

        // dd($data_kelas_mapel[0]->kelas[0]);

        // dd($data_siswa);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        if ($tahun_ajaran == null || $semester == null) {
            abort(404);
        }
        $data_jadwal = Jadwal::where('id_dosen', $request->dosen)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mapel_id', $mapel_id)
            ->select('kelas_id')
            ->with('kelas')
            ->distinct()
            ->get();


        return view('admin.nilaitugas.listkelas', [
            'dosen' => $request->dosen,
            'mapel_id' => $mapel_id,
            'data_jadwal' => $data_jadwal
        ]);
    }

    public function tugas(Request $request, $mapel_id, $id_kelas)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        if ($tahun_ajaran == null || $semester == null) {
            abort(404);
        }
        $data_tugas = Tugas::leftJoin('tugas_kelas', 'tugas.id', '=', 'tugas_kelas.tugas_id')
            ->where('tugas_kelas.kelas_id', $id_kelas)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->get();

        return view('admin.nilaitugas.listtugas', [
            'dosen' => $request->dosen,
            'id_kelas' => $id_kelas,
            'mapel_id' => $mapel_id,
            'data_tugas' => $data_tugas
        ]);
    }

    public function mahasiswa(Request $request, $mapel_id, $id_kelas, $tugas_id)
    {
        // $siswa = Mahasiswa::join('kelas_mahasiswa', 'kelas_mahasiswa.user_id', '=', 'mahasiswa.user_id')->where('id_kelas', $id_kelas)->get();
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $siswa = Mahasiswa::leftJoin('krs_mahasiswa_ekstensis', 'krs_mahasiswa_ekstensis.mahasiswa_id', '=', 'mahasiswa.id')

            ->where(function ($query) use ($id_kelas, $tahun, $semester) {
                $query->where('krs_mahasiswa_ekstensis.kelas_id', '=', $id_kelas)
                    ->orWhere('mahasiswa.kelas_id', '=', $id_kelas)
                    ->orWhere('krs_mahasiswa_ekstensis.tahun_ajaran_id', $tahun->id)
                    ->orWhere('krs_mahasiswa_ekstensis.semester_id', $semester->id);
            })->get('mahasiswa.*');

        $tugas = Tugas::find($tugas_id);
        $data_upload_tugas = HasilTugas::where('tugas_id', $tugas_id)->get();
        // $hasil = NilaiTugas::where('tugas_id', $tugas_id)->get();


        return view('admin.nilaitugas.listmahasiswa', [
            'dosen' => $request->dosen,
            'dosen_id' => $request->dosen,
            'data_mahasiswa' => $siswa,
            'tugas_id' => $tugas_id,
            'id_kelas' => $id_kelas,
            'mapel_id' => $mapel_id,
            'tugas' => $tugas,
            'data_upload_tugas' => $data_upload_tugas,
            // 'data_hasil' => $hasil

        ]);
    }

    public function store(NilaiTugasRequest $request, $mapel_id, $id_kelas, $tugas_id, $mahasiswa_id)
    {
        

        $nilai = NilaiTugas::create([
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $request->dosen,
            'tugas_id' => $tugas_id,
            'nilai_tugas' => $request->nilai_tugas,
            'created_by' => Auth::id()

        ]);

        return redirect()->route('admin.nilaitugas.listMahasiswa', ['dosen' => $request->dosen, 'id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas_id]);
    }

    public function update(NilaiTugasRequest $request, $mapel_id, $id_kelas, $tugas_id, $mahasiswa_id, $dosen)
    {

        $nilai = NilaiTugas::where('mahasiswa_id', $mahasiswa_id)
            ->where('tugas_id', $tugas_id)
            ->where('dosen_id', $dosen)
            ->first();

        $nilai->update([
            'nilai_tugas' => $request->nilai_tugas,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('admin.nilaitugas.listMahasiswa', ['dosen' => $dosen, 'id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas_id]);
    }
}
