<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RaporSiswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\NilaiRapor;
use App\Models\NilaiRaporSiswa;
use App\Models\GradeNilai;
use Illuminate\Http\Request;

class RaporSiswaController extends Controller
{

    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        $tahun_ajaran = '';
        $semester = '';
        $kelas = '';

        $nilai_rapor = NilaiRapor::where('tahun_ajaran', $tahun_ajaran)
        ->where('semester', $semester)
        ->where('kelas_siswa', $kelas)
        ->get();

        $data_nilai_rapor = NilaiRapor::where('tahun_ajaran', $tahun_ajaran)
        ->where('semester', $semester)
        ->where('kelas_siswa', $kelas)
        ->first();

        return view('admin.raporsiswa.index', [
          'data_kelas' => $data_kelas,
          'data_tahun_ajaran' => $data_tahun_ajaran,
          'data_semester' => $data_semester,
          'nilai_rapor' => $nilai_rapor,
          'data_nilai_rapor' => $data_nilai_rapor
        ]);
    }


    public function cariDataLapor(Request $request)
    {
        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        $tahun_ajaran = $request->tahun_ajaran;
        $semester = $request->semester;
        $kelas = $request->kelas;

        $nilai_rapor = NilaiRapor::where('tahun_ajaran', $tahun_ajaran)
        ->where('semester', $semester)
        ->where('kelas_siswa', $kelas)
        ->get();

        $data_nilai_rapor = NilaiRapor::where('tahun_ajaran', $tahun_ajaran)
        ->where('semester', $semester)
        ->where('kelas_siswa', $kelas)
        ->first();

        return view('admin.raporsiswa.index', [
          'data_kelas' => $data_kelas,
          'data_tahun_ajaran' => $data_tahun_ajaran,
          'data_semester' => $data_semester,
          'nilai_rapor' => $nilai_rapor,
          'data_nilai_rapor' => $data_nilai_rapor
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
     * @param  \App\RaporSiswa  $raporSiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nilai_rapor = NilaiRapor::find($id);

        $nilai_rapor_siswa = NilaiRaporSiswa::where('nilai_rapor_id', $nilai_rapor->id)->get();

        $grade_nilai = GradeNilai::all();


        // dd($nilai_rapor_siswa);

        // dd($nilai_rapor->id);


        return view('admin.raporsiswa.show',compact(
          'nilai_rapor',
          'nilai_rapor_siswa',
          'grade_nilai'

        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RaporSiswa  $raporSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(RaporSiswa $raporSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RaporSiswa  $raporSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaporSiswa $raporSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RaporSiswa  $raporSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaporSiswa $raporSiswa)
    {
        //
    }
}
