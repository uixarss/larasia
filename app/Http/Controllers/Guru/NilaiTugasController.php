<?php

namespace App\Http\Controllers\Guru;

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
        // if (Gate::denies('view-nilai')) {
        //     abort(403, 'User does not have the right permissions.');
        // }

        $dosen = Dosen::where('user_id', Auth::id())->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        if ($tahun_ajaran == null || $semester == null) {
            abort(404);
        }

        $mapel = Pengampu::where('id_dosen', $dosen->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->get();
        return view('guru.nilaitugas.index', [
            'mapel' => $mapel
        ]);
    }

    public function kelas($mapel_id)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        if ($tahun_ajaran == null || $semester == null) {
            abort(403, 'Tahun ajaran tidak aktif!');
        }
        $guru = Dosen::where('user_id', '=', Auth::id())->first();
        $data_jadwal = Jadwal::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mapel_id', $mapel_id)
            ->select('kelas_id')
            ->with('kelas')
            ->distinct()
            ->get();


        return view('guru.nilaitugas.listkelas', [
            'mapel_id' => $mapel_id,
            'data_jadwal' => $data_jadwal
        ]);
    }

    public function tugas($mapel_id, $id_kelas)
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
            ->select([
                'tugas.id', 'tugas.kode_tugas', 'tugas.judul_tugas',
                'tugas.deskripsi_tugas', 'tugas.tanggal_mulai', 'tugas.tanggal_akhir',
                'tugas.nama_file_tugas', 'tugas.lokasi_file_tugas', 'tugas.created_by',
                'tugas.mapel_id'
            ])
            ->with('mapel')
            ->get();

        return view('guru.nilaitugas.listtugas', [
            'id_kelas' => $id_kelas,
            'mapel_id' => $mapel_id,
            'data_tugas' => $data_tugas
        ]);
    }

    public function mahasiswa($mapel_id, $id_kelas, $tugas_id)
    {
        // $data_mahasiswa = Mahasiswa::where('kelas_id', $id_kelas)->get();
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $data_mahasiswa = Mahasiswa::leftJoin('krs_mahasiswa_ekstensis', 'krs_mahasiswa_ekstensis.mahasiswa_id', '=', 'mahasiswa.id')

            ->where(function ($query) use ($id_kelas, $tahun, $semester) {
                $query->where('krs_mahasiswa_ekstensis.kelas_id', '=', $id_kelas)
                    ->orWhere('mahasiswa.kelas_id', '=', $id_kelas)
                    ->orWhere('krs_mahasiswa_ekstensis.tahun_ajaran_id', $tahun->id)
                    ->orWhere('krs_mahasiswa_ekstensis.semester_id', $semester->id);
            })->get('mahasiswa.*');


        return view('guru.nilaitugas.listmahasiswa', [
            'data_mahasiswa' => $data_mahasiswa,
            'tugas_id' => $tugas_id,
            'id_kelas' => $id_kelas,
            'mapel_id' => $mapel_id,
        ]);
    }

    public function store(NilaiTugasRequest $request, $mapel_id, $id_kelas, $tugas_id, $mahasiswa_id)
    {
        

        $dosen = Dosen::where('user_id', Auth::id())->first();
        $nilai = NilaiTugas::create([
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen->id,
            'tugas_id' => $tugas_id,
            'nilai_tugas' => $request->nilai_tugas,
            'created_by' => Auth::id()

        ]);

        return redirect()->route('guru.nilaitugas.listMahasiswa', ['id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas_id]);
    }

    public function update(NilaiTugasRequest $request, $mapel_id, $id_kelas, $tugas_id, $mahasiswa_id)
    {
        

        $dosen = Dosen::where('user_id', Auth::id())->first();
        $nilai = NilaiTugas::where('mahasiswa_id', $mahasiswa_id)
            ->where('tugas_id', $tugas_id)
            ->where('dosen_id', $dosen->id)
            ->first();

        $nilai->update([
            'nilai_tugas' => $request->nilai_tugas,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('guru.nilaitugas.listMahasiswa', ['id' => $mapel_id, 'kelas' => $id_kelas, 'tugas' => $tugas_id]);
    }
}
