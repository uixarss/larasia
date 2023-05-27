<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\NilaiHarian;
use App\Models\Mahasiswa;
use App\Models\KelasMahasiswa;
use App\Models\Quiz;
use App\Models\Pengampu;
use App\Models\ResultQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DataNilaiController extends Controller
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

        $siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();

        $data_mapel = MataPelajaran::all();
        $data_guru = Pengampu::where('id_prodi', $siswa->id_prodi)->get();
        // dd($data_guru);

        $guru_id = Pengampu::where('id_prodi', $siswa->id_prodi)->first(); //guru user
        $mapel_id = MataPelajaran::where('id', 1)->first(); //mapel matematika

////////////////////////////////////////////////////////////////////////////////////////
// Nilai Harian (NILAI TUGAS)
        $data_nilai_harian = NilaiHarian::where('siswa_id' , $siswa->id)
        ->where('guru_id', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        // ->whereMonth('created_at' ,$month)
        ->get();

        $avg_harian_rata_rata = NilaiHarian::where('siswa_id' , $siswa->id)
        ->where('guru_id', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        ->avg('nilai_harian');

        if ($avg_harian_rata_rata == 100) {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata,0,6);
        }else {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata,0,5);
        }
        // dd($nilai_harian_rata_rata);

/////////////////////////////////////////////////////////////////////////////////

// Nilai QUIZ
        $data_quiz = Quiz::where('jenisujian_id','1')
        ->where('id_dosen', $guru_id->id_dosen)
        ->where('mapel_id', $guru_id->mapel->id)
        ->with('kelas')->get();

        // dd($data_quiz);

        $arr_quiz = [];
        foreach($data_quiz as  $quiz) {
            $nilai_quiz = $quiz->result_quizzes->whereIn('quiz_id', $quiz)
            ->where('siswa_id', $siswa->mahasiswa->id)
            ->max('nilai_akhir');
            array_push($arr_quiz, $nilai_quiz);
        }
        $arr_quiz = array_filter($arr_quiz);
        $avg_arr_quiz = 0;
        if (count($arr_quiz) > 0) {
            $avg_arr_quiz = array_sum($arr_quiz)/count($arr_quiz);
        }

        if ($avg_arr_quiz == 100) {
            $avg_quiz = substr($avg_arr_quiz,0,6);
        }else {
            $avg_quiz = substr($avg_arr_quiz,0,5);
        }

        // dd($avg_quiz);

/////////////////////////////////////////////////////////////////////////////////

// Nilai UTS
        $data_uts = Quiz::where('jenisujian_id','2')
        ->where('id_dosen', $guru_id->id_dosen)
        ->where('mapel_id', $guru_id->mapel->id)
        ->with('kelas')->get();

        $arr_uts = [];
        foreach($data_uts as  $uts) {
            $nilai_uts = $uts->result_quizzes->whereIn('quiz_id', $uts)
            ->where('siswa_id', $siswa->mahasiswa->id)
            ->max('nilai_akhir');
            array_push($arr_uts, $nilai_uts);
        }
        $arr_uts = array_filter($arr_uts);
        $avg_arr_uts = 0;
        if (count($arr_uts)) {
            $avg_arr_uts = array_sum($arr_uts)/count($arr_uts);
        }

        if ($avg_arr_uts == 100) {
            $avg_uts = substr($avg_arr_uts,0,6);
        }else {
            $avg_uts = substr($avg_arr_uts,0,5);
        }
        // dd($arr_uts);

/////////////////////////////////////////////////////////////////////////////////

// Nilai UAS
        $data_uas = Quiz::where('jenisujian_id','3')
        ->where('id_dosen', $guru_id->id_dosen)
        ->where('mapel_id', $guru_id->mapel->id)
        ->with('kelas')->get();

        $arr_uas = [];
        foreach($data_uas as  $uas) {
            $nilai_uas = $uas->result_quizzes->whereIn('quiz_id', $uas)
            ->where('siswa_id', $siswa->mahasiswa->id)
            ->max('nilai_akhir');
            array_push($arr_uas, $nilai_uas);
        }
        $arr_uas = array_filter($arr_uas);
        $avg_arr_uas = 0;
        if (count($arr_uas) > 0) {
            $avg_arr_uas = array_sum($arr_uas)/count($arr_uas);
        }

        if ($avg_arr_uas == 100) {
            $avg_uas = substr($avg_arr_uas,0,6);
        }else {
            $avg_uas = substr($avg_arr_uas,0,5);
        }
        // dd($arr_uas);



        return view('siswa.datanilai.index', compact([
          'data_mapel','data_guru','guru_id','mapel_id',
          'data_nilai_harian','nilai_harian_rata_rata',
          'data_quiz','avg_quiz',
          'data_uts','avg_uts',
          'data_uas','avg_uas'
          ]));
    }


    public function cariNilai(Request $request)
    {

        $siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();

        $data_mapel = MataPelajaran::all();
        $data_guru = Guru::all();

        $guru_id = Guru::where('user_id', $request->guru_id)->first(); //guru user
        $mapel_id = MataPelajaran::where('id', $request->mapel_id)->first(); //mapel matematika


        // dd($guru_id->user_id,$mapel_id->id);

////////////////////////////////////////////////////////////////////////////////////////
// Nilai Harian (NILAI TUGAS)
        $data_nilai_harian = NilaiHarian::where('siswa_id' , $siswa->id)
        ->where('guru_id', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        // ->whereMonth('created_at' ,$month)
        ->get();


        $avg_harian_rata_rata = NilaiHarian::where('siswa_id' , $siswa->id)
        ->where('guru_id', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        ->avg('nilai_harian');

        if ($avg_harian_rata_rata != null) {
          if ($avg_harian_rata_rata == 100) {
              $nilai_harian_rata_rata = substr($avg_harian_rata_rata,0,6);
          }else {
              $nilai_harian_rata_rata = substr($avg_harian_rata_rata,0,5);
          }
        }else{
          $nilai_harian_rata_rata = '0';
        }



        // dd($nilai_harian_rata_rata);

/////////////////////////////////////////////////////////////////////////////////

// Nilai QUIZ
        $data_quiz = Quiz::where('jenisujian_id','1')
        ->where('dibuat_oleh', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        ->with('kelas')->get();


        $arr_quiz = [];
        foreach($data_quiz as  $quiz) {
          $nilai_quiz = $quiz->result_quizzes->whereIn('quiz_id', $quiz)
          ->where('siswa_id', $siswa->id)
          ->max('nilai_akhir');
          array_push($arr_quiz, $nilai_quiz);
        }

        // dd($arr_quiz);

        if ($arr_quiz != null) {
          $arr_quiz = array_filter($arr_quiz);

            $avg_arr_quiz = array_sum($arr_quiz)/count($arr_quiz);

            if ($avg_arr_quiz == 100) {
                $avg_quiz = substr($avg_arr_quiz,0,6);
            }else {
                $avg_quiz = substr($avg_arr_quiz,0,5);
            }
        }else{
          $avg_quiz = '0';
        }

        // dd($avg_quiz);

/////////////////////////////////////////////////////////////////////////////////

// Nilai UTS
        $data_uts = Quiz::where('jenisujian_id','2')
        ->where('dibuat_oleh', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        ->with('kelas')->get();

        $arr_uts = [];
        foreach($data_uts as  $uts) {
            $nilai_uts = $uts->result_quizzes->whereIn('quiz_id', $uts)
            ->where('siswa_id', $siswa->id)
            ->max('nilai_akhir');
            array_push($arr_uts, $nilai_uts);
        }

        if ($arr_uts != null) {
          $arr_uts = array_filter($arr_uts);

          $avg_arr_uts = array_sum($arr_uts)/count($arr_uts);

          if ($avg_arr_uts == 100) {
              $avg_uts = substr($avg_arr_uts,0,6);
          }else {
              $avg_uts = substr($avg_arr_uts,0,5);
          }
        }else{
          $avg_uts = '0';
        }



        // dd($arr_uts);

/////////////////////////////////////////////////////////////////////////////////

// Nilai UAS
        $data_uas = Quiz::where('jenisujian_id','3')
        ->where('dibuat_oleh', $guru_id->user_id)
        ->where('mapel_id', $guru_id->mapel_id)
        ->with('kelas')->get();

        $arr_uas = [];
        foreach($data_uas as  $uas) {
            $nilai_uas = $uas->result_quizzes->whereIn('quiz_id', $uas)
            ->where('siswa_id', $siswa->id)
            ->max('nilai_akhir');
            array_push($arr_uas, $nilai_uas);
        }
        if ($arr_uas != null) {

          $arr_uas = array_filter($arr_uas);

          $avg_arr_uas = array_sum($arr_uas)/count($arr_uas);

          if ($avg_arr_uas == 100) {
              $avg_uas = substr($avg_arr_uas,0,6);
          }else {
              $avg_uas = substr($avg_arr_uas,0,5);
          }
        }else{
          $avg_uas = '0';
        }

        // dd($arr_uas);


        return view('siswa.datanilai.index', compact([
          'data_mapel','data_guru','guru_id','mapel_id',
          'data_nilai_harian','nilai_harian_rata_rata',
          'data_quiz','avg_quiz',
          'data_uts','avg_uts',
          'data_uas','avg_uas'

          ]));
    }

}
