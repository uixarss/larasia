<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataOrangTua;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPelajaranController extends Controller
{
    //List jadwal pelajaran siswa
    public function list()
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        
        $kelas = Mahasiswa::where('user_id', '=', Auth::id())->first();
        $data_jadwal = Jadwal::where('kelas_id', $kelas->kelas_id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            // ->groupBy('hari_id')
            ->with('hari', 'waktu', 'dosen', 'semester', 'tahunajaran', 'mapel')
            ->get();
        return response()->json($data_jadwal);
    }


    //List jadwal pelajaran ortu siswa
    public function listOrtu()
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $ortu = DataOrangTua::where('user_id', '=', Auth::id())->first();
        $siswa = Siswa::where('id', '=', $ortu->siswa_id)->first();
        $data_jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            // ->groupBy('hari_id')
            ->with('hari', 'waktu', 'guru', 'semester', 'tahunajaran', 'mapel')
            ->get();
        return response()->json($data_jadwal);
    }

    //List jadwal pelajaran guru
    public function listGuru()
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        
        $guru = Dosen::where('user_id', '=', Auth::id())->first();

        $data_jadwal = Jadwal::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            // ->groupBy('hari_id')
            ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
            ->get();
        
        return response()->json($data_jadwal);
    }
}
