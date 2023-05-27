<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Waktu;
use App\JadwalPelajaranGuru;
use App\Jobs\ProcessGeneticAlgorithm;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Setting;
use App\Algoritma\GenerateAlgoritma;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Prodi;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalPelajaranGuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_guru = Dosen::all();
        $data_hari = Hari::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();
        $data_kelas = Kelas::all();
        $data_mapel = MataPelajaran::all();
        $data_waktu = Waktu::all();
        $data_ruangan = Ruangan::all();
        $data_jadwal = Jadwal::get();
        $data_prodi = Prodi::all();

        return view('pegawai.jadwalpelajaranguru.index', [
            'data_guru' => $data_guru,
            'data_hari' => $data_hari,
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester,
            'data_jadwal' => $data_jadwal,
            'data_kelas' => $data_kelas,
            'data_mapel' => $data_mapel,
            'data_waktu' => $data_waktu,
            'data_ruangan' => $data_ruangan,
            'data_prodi' => $data_prodi
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari_id' => 'required',
            'waktu_id' => 'required',
            'ruangan_id' => 'required',
            'prodi_id' => 'required'
        ]);

        $data_jadwal = Jadwal::create([
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'semester_id' => $request->semester_id,
            'kelas_id' => $request->kelas_id,
            'id_dosen' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari_id' => $request->hari_id,
            'waktu_id' => $request->waktu_id,
            'ruangan_id' => $request->ruangan_id,
            'prodi_id' => $request->prodi_id
        ]);

        return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $this->validate($request,[
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari_id' => 'required',
            'waktu_id' => 'required',
            'ruangan_id' => 'required',
            'prodi_id' => 'required'
        ]);
        $data_jadwal = Jadwal::find($id);
        
        $data_jadwal->update([
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'semester_id' => $request->semester_id,
            'kelas_id' => $request->kelas_id,
            'id_dosen' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari_id' => $request->hari_id,
            'waktu_id' => $request->waktu_id,
            'ruangan_id' => $request->ruangan_id,
            'prodi_id' => $request->prodi_id
        ]);

        return redirect()->back();
    }
}
