<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\NilaiSiswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaranGuruKelas;
use App\Models\NilaiHarian;
use App\Models\NilaiAkhir;
use App\Models\GradeNilai;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NilaiSiswaController extends Controller
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
      $data_mapel = MataPelajaran::all();

      // $data_kelas_mapel = TahunAjaranGuruKelas::all();

      $tahun_ajaran = TahunAjaran::
          // where('status', true)
          where('start_date', '>', now())
          ->orWhere('end_date', '<', now())
          ->first();

      $data_kelas_mapel = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
          ->get();

        return view('admin.nilaisiswa.index', compact('data_kelas', 'data_mapel','data_kelas_mapel'));
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


    public function pilihMapel(Request $request, $id)
    {

        $data_kelas = Kelas::find($id);

        // $data_siswa = Siswa::where('kelas_id', $data_kelas->id)->get();
        //
        // $data_mapel = MataPelajaran::all();
        //
        //
        $mapel = MataPelajaran::where('id', $request->id)->first();

        return response()->json($mapel);


        // $matpel = NilaiAkhir::where('mapel_id', $request->id)->first();
        //
        //
        // $tahun_ajaran = TahunAjaran::
        //     // where('status', true)
        //     where('start_date', '>', now())
        //     ->orWhere('end_date', '<', now())
        //     ->first();
        //
        // $semester = Semester::where('id', $tahun_ajaran->id)->first();
        //
        //
        //
        //
        // return view('admin.nilaisiswa.show', compact(
        //   'data_siswa',
        //   'data_kelas',
        //   'mapel',
        //   'tahun_ajaran',
        //   'semester',
        //   'data_mapel',
        //   'matpel'
        //
        // ));

        // $data_mapel = $data_mapel->id;

        // return dd($data_mapel);

        // return response()->json($data_mapel);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
          $data_kelas = Kelas::find($id);


          $data_guru = Guru::where('user_id', Auth::id())->first();

          $tahun_ajaran = TahunAjaran::
              // where('status', true)
              where('start_date', '>', now())
              ->orWhere('end_date', '<', now())
              ->first();

          $semester = Semester::where('id', $tahun_ajaran->id)->first();

          $data_siswa = Siswa::where('kelas_id', $data_kelas->id)->get();


          $data_mapel1 = $request->mapel_id;

          if ($data_mapel1) {

            $data_mape = MataPelajaran::where('id', $request->mapel_id)->first();
            dd($data_mape);
          }

          // dd($data_siswa->nilai_akhir);

          foreach ($data_siswa  as $siswa) {


              $nilaiHarianSiswa = $siswa->nilai_harian->where('siswa_id','=', $siswa->id)
              ->where('mapel_id','=', 3)
              ->where('tahun_ajaran_id','=', $tahun_ajaran->id)
              ->where('semester_id','=', $semester->id)
              ->first();

              $nilaiakhirSiswa = $siswa->nilai_akhir->where('siswa_id','=', $siswa->id)
              ->where('mapel_id','=', 3)
              ->where('tahun_ajaran_id','=', $tahun_ajaran->id)
              ->where('semester_id','=', $semester->id)
              ->first();

              // dd($nilaiHarianSiswa->nilai_harian);
          }



          $data_mapel = MataPelajaran::all();

          // dd($data_mapel);


          $data_nilai_harian = NilaiHarian::with('nilai_harian')->cursor();

          $data_nilai_akhir = NilaiAkhir::take(1500)->get();

          $grade_nilai = GradeNilai::all();


          // $nilai_harian_siswa = Siswa::where('kelas_id', $data_kelas->id)->first();

          $arr=[];
          foreach ($data_siswa as $key => $siswa) {

            $data_guru = Guru::where('user_id', Auth::id())->first();

            $tahun_ajaran = TahunAjaran::
                // where('status', true)
                where('start_date', '>', now())
                ->orWhere('end_date', '<', now())
                ->first();

            $semester = Semester::where('id', $tahun_ajaran->id)->first();


            // $mapel_id = $request->mapel_id;
            $mapel_id = 5;



            if ($mapel_id == 5) {

              $mapel = MataPelajaran::where('id', 5)->first();

              $sum_nilai_harian = DB::table('nilai_harian')
              ->where('siswa_id', $siswa->id)
              ->where('mapel_id', $mapel->id)
              ->where('tahun_ajaran_id', $tahun_ajaran->id)
              ->where('semester_id', $semester->id)
              ->avg('nilai_harian');

              if ($sum_nilai_harian == 100) {
                  $sum_nilai_harian = substr($sum_nilai_harian,0,6);
              }else {
                  $sum_nilai_harian = substr($sum_nilai_harian,0,5);
              }

              $na = NilaiAkhir::where('siswa_id', $siswa->id)->where('mapel_id', $mapel->id)->first(); //data nilai akhir
              $arr2 = [
                'id' => $siswa->id,
                'nilai_rata2' => $sum_nilai_harian,
                'mapel_id' => $mapel->id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'semester_id' => $semester->id,

                'id_na' => $na //data nilai akhir
              ];
              array_push($arr,$arr2);

            }else {
              $mapel = MataPelajaran::where('id', $mapel_id)->first();

              $sum_nilai_harian = DB::table('nilai_harian')
              ->where('siswa_id', $siswa->id)
              ->where('mapel_id', $mapel_id)
              ->where('tahun_ajaran_id', $tahun_ajaran->id)
              ->where('semester_id', $semester->id)
              ->avg('nilai_harian');

              if ($sum_nilai_harian == 100) {
                  $sum_nilai_harian = substr($sum_nilai_harian,0,6);
              }else {
                  $sum_nilai_harian = substr($sum_nilai_harian,0,5);
              }

              $na = NilaiAkhir::where('siswa_id', $siswa->id)->where('mapel_id', $mapel_id)->first(); //data nilai akhir

              $arr2 = [
                'id' => $siswa->id,
                'nilai_rata2' => $sum_nilai_harian,
                'mapel_id' => $mapel->id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'semester_id' => $semester->id,

                'id_na' => $na //data nilai akhir
              ];
              array_push($arr,$arr2);
            }





          }

          // dd(pilihMapel());



          return view('admin.nilaisiswa.show', compact(
            'data_kelas',
            'data_guru',
            'tahun_ajaran',
            'semester',
            'data_siswa',
            'data_nilai_harian',
            'data_nilai_akhir',
            'arr',
            'grade_nilai',
            'data_mapel',

            'nilaiHarianSiswa'



          ));
    }







    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSiswa $nilaiSiswa)
    {
        //
    }
}
