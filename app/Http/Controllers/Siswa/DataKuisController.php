<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Support\Facades\Auth;
use App\User;

use App\DataKuis;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Quiz;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Question;
use App\Models\Answer;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Option;
use App\Models\ResultQuiz;
use Illuminate\Http\Request;

class DataKuisController extends Controller
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

      $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
      $tahun_ajaran = TahunAjaran::where('status', '1')->first();
      $semester = Semester::where('status', '1')->first(); 
      if($tahun_ajaran == null || $semester == null){
      abort(404);
      }

      $data_kuis = Quiz::where('jenisujian_id','1')
      ->with('kelas')
      ->where('id_tahun_ajaran', $tahun_ajaran->id)
      ->where('id_semester', $semester->id)->get();
      $data_answer = Answer::whereJawaban('benar')->get();

      // foreach ($data_kuis as $key => $kuis) {
      //   foreach ($kuis->result_quizzes as $key => $result_quizzes) {
      //
      //     if($result_quizzes->quiz_id == $kuis->id && $result_quizzes->siswa_id == $siswa->id) {
      //       echo "$kuis->id";
      //     }else{
      //       dd('false');
      //     }
      //
      //   }
      // }

      // @php
      // $arr_collect = collect($arr);
      // $arr_collect_temp = $arr_collect->where('ngerjain', false);
      // @endphp
      //
      // @foreach($arr_collect_temp as $cc)
      // {{$cc->id ?? '0'}}
      // @endforeach

      $arr=[];
      foreach ($data_kuis as $key => $kuis) {
        foreach ($kuis->kelas as $kelas) {
          if ($mahasiswa->kelas_id == $kelas->id) {
            $hasil = ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->first();
            $ngerjain = $hasil ? $hasil : false;

            $arr2 = [
              'id'=> $kuis->id,
              'siswa'=> $mahasiswa->id,
              'ngerjain'=> $ngerjain
            ];
            array_push($arr, $arr2);
          }
          // dd($arr2);
        }
      }




      // dd($arr2);


      return view('siswa.datakuis.index', [
        'data_kuis' => $data_kuis,
        'data_answer' => $data_answer,
        'siswa' => $mahasiswa,
        'arr' => $arr

      ]);
    }


    public function mulaikuis($id)
    {

       $data_siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();

        //where kuis id, id
       $data_quiz = Quiz::find($id);

       $data_question = Question::where('quiz_id', $data_quiz->id)->get();
       // $data_question = Question::where('quiz_id',$data_quiz->id)->paginate(1);

       // dd($data_question);

       // dd($data_question);

       $data_option = Option::where('question_id', $data_quiz->id)->first();
       // $data_option = Option::all();

       // $data_answer = Answer::where('option_id', $data_quiz->id)->first();

       $data_answer = Answer::where('siswa_id', $data_siswa->id)
       ->where('quiz_id', $data_quiz->id)
       ->whereJawaban('benar', $data_siswa->id)->get();

       // dd($data_answer);



       $result_quiz = ResultQuiz::where('siswa_id', $data_siswa->id)
       ->where('quiz_id', $data_quiz->id)->first();

       // dd($result_quiz);
       //


        return view('siswa.datakuis.mulaikuis',[
          'data_siswa' => $data_siswa,
          'data_quiz'  => $data_quiz,
          'data_question' => $data_question,
          'data_option' => $data_option,
          'data_answer' => $data_answer,
          'result_quiz' => $result_quiz
        ]);

    }



    public function createStatusQuiz(Request $request, $id)
    {

        $data_siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();

          ResultQuiz::create([
          'siswa_id' => $data_siswa->id,
          'quiz_id' => $request->id,
          'nilai_akhir' => $request->nilaiakhir
        ]);

        return ResultQuiz::all();

        // return $request->all();
    }




    public function jawab(Request $request)
    {
        $data_siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        //jika id quiz
        if (Answer::where('quiz_id', $request->id_quiz) != null) {
          $data_answer = Answer::updateOrCreate([
              //create
              'question_id' => $request->id_question,
              'quiz_id' => $request->id_quiz,
              'siswa_id' => $data_siswa->id,

          ],
          [
              //update
              'option_id' => $request->id_option,
              'jawaban' => $request->nilai
          ]);
        }
      }

    public function kuis($id)
    {
       //where kuis id, id
      $data_quiz = Quiz::find($id);

      $data_question = Question::where('quiz_id', $data_quiz->id)->get();
      // $data_question = Question::where('quiz_id',$data_quiz->id)->paginate(1);

      $data_option = Option::where('question_id', $data_quiz->id)->get();
      // $data_option = $data_question->options->get();

      // $data_answer = Answer::where('data_option', $data_quiz->id);

      // return view('siswa.datakuis.kuis',compact([
      //   'data_quiz',
      //   'data_question',
      //   'data_option',
      //   'data_answer'
      // ]))->with('options');

      return view('siswa.datakuis.kuis',[
        'data_quiz'          => $data_quiz,
        'data_question' => $data_question,
        // 'data_option' => $data_option,
        // 'data_answer' => $data_answer
      ]);
    }
    ////////////

    public function getSoal($id)
    {
      $soal = Question::find($id);
      return view('siswa.datakuis.get_soal', compact('soal'));
    }

    public function fetch_data(Request $request){
      if($request->ajax()){
          $data_question = Question::where('quiz_id',$data_quiz->id)->paginate(1);
          return view('siswa.datakuis.kuis', compact('data_question'))->render();
      }
    }

    public function getRequset()
    {
        $data_question = Question::all();
        $data_option = Option::all();

        return ([
          'data pertanyaan' => $data_question,
          'data jawaban' => $data_option]);
    }

    public function nilaikuis()
    {
      return view('siswa.datakuis.nilaikuis');
    }


}
