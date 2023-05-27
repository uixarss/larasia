<?php

namespace App\Http\Controllers\Siswa;
use Auth;
use App\User;

use App\DataKuis;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\ResultQuiz;

class DataUjianController extends Controller
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

        $data_uts = Quiz::where('jenisujian_id','2')->with('kelas')->get();

        $data_answer = Answer::whereJawaban('benar')->get();

        $arruts=[];
        foreach ($data_uts as $key => $uts) {
          foreach ($uts->kelas as $kelas) {
            if ($mahasiswa->kelas_id == $kelas->id) {
              $hasil = ResultQuiz::where('quiz_id', $uts->id)->where('siswa_id', $mahasiswa->id)->first();
              $ngerjain = $hasil ? $hasil : false;
              $arr2 = [
                'id'=> $uts->id,
                'siswa'=> $mahasiswa->id,
                'ngerjain'=> $ngerjain
              ];
              array_push($arruts, $arr2);
            }
          }
        }


        $data_uas = Quiz::where('jenisujian_id','3')->get();

        $arruas=[];
        foreach ($data_uas as $key => $uas) {
          foreach ($uas->kelas as $kelas) {
            if ($id_kelas == $kelas->id) {
              $hasil = ResultQuiz::where('quiz_id', $uas->id)->where('siswa_id', $mahasiswa->id)->first();
              $ngerjain = $hasil ? $hasil : false;
              $arr2 = [
                'id'=> $uas->id,
                'siswa'=> $kelas_mahasiswa->mahasiswa->id,
                'ngerjain'=> $ngerjain
              ];
              array_push($arruas, $arr2);
            }
          }
        }


        return view('siswa.dataujian.index', [
        'data_answer' => $data_answer,
        'siswa' => $mahasiswa,
        'data_uas' => $data_uas,
        'data_uts' => $data_uts,
        'arruas' => $arruas,
        'arruts' => $arruts
      ]);

    }

//////////////////
public function mulaiujian($id)
{

    $data_siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();

    //where kuis id, id
   $data_quiz = Quiz::find($id);

   $data_question = Question::where('quiz_id', $data_quiz->id)->get();
   // $data_question = Question::where('quiz_id',$data_quiz->id)->paginate(1);

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

    return view('siswa.dataujian.mulaiujian',[
      'data_siswa' => $data_siswa,
      'data_quiz'          => $data_quiz,
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

public function ujian($id)
{
   //where kuis id, id
  $data_quiz = Quiz::find($id);

  $data_question = Question::where('quiz_id', $data_quiz->id)->get();
  // $data_question = Question::where('quiz_id',$data_quiz->id)->paginate(1);

  $data_option = Option::where('question_id', $data_quiz->id)->get();
  // $data_option = $data_question->options->get();

  // $data_answer = Answer::where('data_option', $data_quiz->id);

  // return view('siswa.dataujian.kuis',compact([
  //   'data_quiz',
  //   'data_question',
  //   'data_option',
  //   'data_answer'
  // ]))->with('options');

  return view('siswa.dataujian.ujian',[
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
  return view('siswa.dataujian.get_soal', compact('soal'));
}

public function fetch_data(Request $request){
  if($request->ajax()){
      $data_question = Question::where('quiz_id',$data_quiz->id)->paginate(1);
      return view('siswa.dataujian.ujian', compact('data_question'))->render();
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

///////////////////////



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
