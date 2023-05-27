<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Waktu;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Siswa;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KrsMahasiswaEkstensi;

class JadwalPelajaranSiswaController extends Controller
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
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();


        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $data_ekstensi_kelas = KrsMahasiswaEkstensi::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->select('kelas_id')
            ->get();

            $data_ekstensi_dosen = KrsMahasiswaEkstensi::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->select('id_dosen')
            ->get();

        $data_jadwal = Jadwal::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('kelas_id', $mahasiswa->kelas_id)
            ->orderBy('hari_id', 'ASC')
            ->get();

        $data_jadwal_ekstensi = Jadwal::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->whereIn('kelas_id', $data_ekstensi_kelas)
            ->whereIn('id_dosen', $data_ekstensi_dosen)
            ->orderBy('hari_id', 'ASC')
            ->get();

        return view('siswa.jadwalpelajaran.index', [
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'data_jadwal' => $data_jadwal,
            'data_jadwal_ekstensi' => $data_jadwal_ekstensi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
