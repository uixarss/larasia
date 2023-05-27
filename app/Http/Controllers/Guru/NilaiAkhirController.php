<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaranGuruKelas;
use App\Models\NilaiHarian;
use App\Models\NilaiAkhir;
use App\Models\GradeNilai;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NilaiAkhirController extends Controller
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
    // if (Gate::denies('view-nilai')) {
    //   abort(403, 'User does not have the right permissions.');
    // }
    $data_kelas = Kelas::all();
    $data_mapel = MataPelajaran::all();

    // $data_kelas_mapel = TahunAjaranGuruKelas::all();

    // $tahun_ajaran = TahunAjaran::
    //     where('status', true)
    //     // where('start_date', '>', now())
    //     // ->orWhere('end_date', '<', now())
    //     ->first();


    $tahun_ajaran = TahunAjaran::where('status', '1')->first();
    $semester = Semester::where('status', '1')->first();
    $guru = Dosen::where('user_id', '=', Auth::id())->first();
    $data_jadwal = Jadwal::where('id_dosen', $guru->id)
      ->where('tahun_ajaran_id', $tahun_ajaran->id)
      ->where('semester_id', $semester->id)
      ->select('kelas_id')
      ->with('kelas')
      ->distinct()
      ->get();
    $data_kelas_mapel = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
      ->get();


    return view('guru.inputnilaiakhir.index', compact('data_kelas', 'data_mapel', 'data_kelas_mapel', 'data_jadwal'));
  }

  public function inputnilai()
  {
    return view('guru.inputnilaiakhir.nilaiakhir');
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
   * @param  \App\NilaiAkhir  $nilaiAkhir
   * @return \Illuminate\Http\Response
   */
  public function show(NilaiAkhir $nilaiAkhir)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\NilaiAkhir  $nilaiAkhir
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if (Gate::denies('edit-nilai')) {
      abort(403, 'User does not have the right permissions.');
    }
    $data_kelas = Kelas::find($id);


    $data_guru = Dosen::where('user_id', Auth::id())->first();

    $tahun_ajaran = TahunAjaran::where('status', 1)
      // where('start_date', '>', now())
      // ->orWhere('end_date', '<', now())
      ->first();

    $semester = Semester::where('status', 1)->first();

    $data_siswa = Siswa::where('kelas_id', $data_kelas->id)
      ->with('nilai_akhir.mapel')
      ->with('nilai_harian.mapel')
      ->get();

    $nilai_harian_siswa = Siswa::where('kelas_id', $data_kelas->id)->first();

    $data_nilai_harian = NilaiHarian::where('siswa_id', $nilai_harian_siswa->id)
      ->where('mapel_id', $data_guru->mapel_id)
      ->where('tahun_ajaran_id', $tahun_ajaran->id)
      ->where('semester_id', $semester->id)->first();


    // $data_nilai_akhir = NilaiAkhir::with('nilai_akhir')->cursor();


    $grade_nilai = GradeNilai::all();


    // $sum_nilai_harian = NilaiHarian::where('siswa_id', $nilai_harian_siswa->id)
    // ->where('mapel_id', $data_guru->mapel->id)
    // ->where('tahun_ajaran_id', $tahun_ajaran->id)
    // ->where('semester_id', $semester->id)
    // ->avg('nilai_harian');

    $arr = [];
    foreach ($data_siswa as $key => $siswa) {
      $sum_nilai_harian1 = DB::table('nilai_harian')
        ->where('siswa_id', $siswa->id)
        ->where('mapel_id', $data_guru->mapel_id)
        // ->where('guru_id', $data_guru->id)
        ->where('tahun_ajaran_id', $tahun_ajaran->id)
        ->where('semester_id', $semester->id)
        ->avg('nilai_harian');

      if ($sum_nilai_harian1 == 100) {
        $sum_nilai_harian = substr($sum_nilai_harian1, 0, 6);
      } else {
        $sum_nilai_harian = substr($sum_nilai_harian1, 0, 5);
      }


      $data_guru = Guru::where('user_id', Auth::id())->first();

      $tahun_ajaran = TahunAjaran::
        // where('status', true)
        where('start_date', '>', now())
        ->orWhere('end_date', '<', now())
        ->first();

      $semester = Semester::where('id', $tahun_ajaran->id)->first();

      $na = NilaiAkhir::where('siswa_id',  $siswa->id)->first(); //data nilai akhir

      $arr2 = [
        'id' => $siswa->id,
        'nilai_rata2' => $sum_nilai_harian,
        'mapel_id' => $data_guru->mapel->id,
        'tahun_ajaran_id' => $tahun_ajaran->id,
        'semester_id' => $semester->id,

        'id_na' => $na //data nilai akhir
      ];
      array_push($arr, $arr2);
    }

    // dd($arr);



    // $data_nilai_harian_siswa = NilaiHarian::where('siswa_id', 4)->where('mapel_id', 5)->get();

    // dd($data_nilai_harian_siswa[0]->siswa->id);

    return view('guru.inputnilaiakhir.edit', compact(
      'data_kelas',
      'data_guru',
      'tahun_ajaran',
      'semester',
      'data_siswa',
      'data_nilai_harian',

      'sum_nilai_harian',
      'arr',
      'grade_nilai'
    ));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\NilaiAkhir  $nilaiAkhir
   * @return \Illuminate\Http\Response
   */
  public function updatenilai(Request $request, $id)
  {

    if (Gate::denies('update-nilai')) {
      abort(403, 'User does not have the right permissions.');
    }
    $data_siswa = Siswa::find($id);

    $nilaiAkhir = NilaiAkhir::all();

    $data_guru = Guru::where('user_id', Auth::id())->first();

    $dataharian = $request->nilai_harian;
    $dataketerampilan = $request->nilai_keterampilan;

    // dd($dataharian);


    $nilai_akhir_siswa = ($dataharian + $dataketerampilan) / 2;

    // dd($dataharian, $dataketerampilan, $nilai_akhir_siswa);

    $cekDataNilaiAkhir = NilaiAkhir::where('siswa_id', $request->siswa_id)
      ->where('mapel_id', $request->mapel_id)
      ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
      ->where('semester_id', $request->semester_id)
      ->where('guru_id', $data_guru->id)
      ->exists();

    // dd($cekDataNilaiAkhir);

    if ($cekDataNilaiAkhir) {

      $data_nilai_akhir = NilaiAkhir::where('id', $request->id_na)->first();


      $data_nilai_akhir->update([
        'nilai_akhir' => $nilai_akhir_siswa
      ]);

      // dd($data_nilai_akhir);

      return back();
    }

    $data_nilai_akhir = NilaiAkhir::create([
      'siswa_id'  => $request->siswa_id,
      'guru_id'  => $data_guru->id,
      'mapel_id'  => $request->mapel_id,
      'tahun_ajaran_id'  => $request->tahun_ajaran_id,
      'semester_id'  => $request->semester_id,
      'nilai_akhir' => $nilai_akhir_siswa
    ]);



    return back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\NilaiAkhir  $nilaiAkhir
   * @return \Illuminate\Http\Response
   */
  public function destroyNilaiAkhir($id, $id_na)
  {
    if (Gate::denies('delete-nilai')) {
      abort(403, 'User does not have the right permissions.');
    }
    $data_siswa = Siswa::find($id);

    $data_nilai_akhir = NilaiAkhir::where('id', $id_na)->where('siswa_id', $data_siswa->id)->first();

    $data_nilai_akhir->delete($data_nilai_akhir);

    return back();
  }
}
