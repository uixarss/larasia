<?php

namespace App\Http\Controllers\Guru\WaliKelas;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaranGuruKelas;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\NilaiHarian;
use App\Models\NilaiAkhir;
use App\Models\GradeNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_guru = Guru::where('user_id', Auth::user()->id)->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        $data_walikelas = TahunAjaranGuruKelas::where('guru_id', $data_guru->id)
        ->where('tahun_ajaran_id', $tahun_ajaran->id)
        ->get();

        return view('guru.walikelas.datanilai.index', [
          'data_walikelas' => $data_walikelas
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
    public function show(Request $request, $id)
    {
        $data_kelas = Kelas::find($id);

        $tahun_ajaran = TahunAjaran::
            // where('status', true)
            where('start_date', '>', now())
            ->orWhere('end_date', '<', now())
            ->first();

        $semester = Semester::where('id', $tahun_ajaran->id)->first();

        $grade_nilai = GradeNilai::all();

        $data_guru = Guru::all();

        $data_siswa = Siswa::where('kelas_id', $data_kelas->id)
        ->with('nilai_akhir.mapel')
        ->with('nilai_harian.mapel')
        ->get();


        // $matapelajaran = MataPelajaran::where('id' , $request->mapel_id)->first();

        $guru_id = Guru::where('id' , $request->guru_id)->first();

        // dd($guru_id->mapel_id);

        //////////////////////////////////////////////////////////////////////////


        $arr=[];
        foreach ($data_siswa as $key => $siswa) {
          $sum_nilai_harian1 = DB::table('nilai_harian')
          ->where('siswa_id', $siswa->id)
          ->where('mapel_id', $guru_id->mapel_id)
          // ->where('guru_id', $guru_id->id)
          ->where('tahun_ajaran_id', $tahun_ajaran->id)
          ->where('semester_id', $semester->id)
          ->avg('nilai_harian');

          if ($sum_nilai_harian1 == 100) {
              $sum_nilai_harian = substr($sum_nilai_harian1,0,6);
          }else {
              $sum_nilai_harian = substr($sum_nilai_harian1,0,5);
          }

          $tahun_ajaran = TahunAjaran::
              // where('status', true)
              where('start_date', '>', now())
              ->orWhere('end_date', '<', now())
              ->first();

          $semester = Semester::where('id', $tahun_ajaran->id)->first();

          $arr2 = [
            'id' => $siswa->id,
            'nilai_rata2' => $sum_nilai_harian,
            'guru_id' => $guru_id->id,
            'mapel_id' => $guru_id->mapel_id,
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'semester_id' => $semester->id,
          ];
          array_push($arr,$arr2);
        }

        // dd($arr);

        //////////////////////////////////////////////////////////////////////////

        return view('guru.walikelas.datanilai.show',compact(
          'data_kelas',
          'tahun_ajaran',
          'semester',
          'data_siswa',
          'grade_nilai',
          'data_guru',
          'guru_id',
          'arr'

        ));
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
