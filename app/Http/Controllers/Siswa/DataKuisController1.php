<?php

namespace App\Http\Controllers\Siswa;

use Auth;
use App\User;

use App\DataKuis;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
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

      $siswa = Siswa::where('user_id', Auth::id())->first();

      $data_kuis = Quiz::where('jenisujian_id','1')->get();


      $tes = '--------------------------- : ';
      $arr=[];
      foreach ($data_kuis as $key => $kuis) {
        // $tes .= $kuis->kode_soal.', ';
        $hasil = ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $siswa->id)->first();
        $ngerjain = $hasil ? $hasil : false;
        $arr2 = [
          'id'=> $kuis->id,
          'name'=> $kuis->user->name,
          'judul_kuis'=> $kuis->judul_kuis,
          'nama_mapel'=> $kuis->mapel->nama_mapel,
          'tanggal_mulai'=> $kuis->tanggal_mulai,
          'tanggal_akhir'=> $kuis->tanggal_akhir,
          'kode_soal'=> $kuis->kode_soal,
          'jumlah_soal'=> $kuis->jumlah_soal,
          'durasi'=> $kuis->durasi,
          'ngerjain'=>$ngerjain,
        ];
        array_push($arr, $arr2);
      }

      // $hasil = ResultQuiz::where('quiz_id', 1)->where('siswa_id', Auth::user()->id);

      // $bebassih = ResultQuiz::where('quiz_id', '1')->where('siswa_id', 2)->first();
      // // $bebassih = ResultQuiz::where('quiz_id', '1')->where('siswa_id', $data_siswa->id)->first();
      // $apaaja = null;
      // $cek= $bebassih? true : false;

      // dd($bebassih[0]->nilai_akhir);
      // dd($arr);
      // dd($arr);
      // //
      // // // $data_result_quiz = ResultQuiz::all();
      // $data_result_quiz = ResultQuiz::where('quiz_id' 1);
      //
      $data_answer = Answer::whereJawaban('benar')->get();

      // dd($data_answer);

      // $data_result_quiz = ResultQuiz::find(47);
      // dd($data_result_quiz);

      //belum ada data nya di reslut quiz nya

      // $data_kuis1 = Quiz::all();
      // dd($data_kuis1);
      //
      // nih misal mau nampilin yang rlsut quiz nya di table quiz
      //ini tuh brrt mw ngambil data resultquiz, ssuai siswa yang login tah?
      //kalau itu sih udah dik, ira ngmong mul? kenfearan emg? kcil bgt, kek org gldeng wkwkw
      //di telpon aja tah eh vn gtu di wa nggmng nyaa?, coba sok,

      return view('siswa.datakuis.index', [
        'data_kuis' => $arr,
        'data_answer' => $data_answer,
        'siswa' => $siswa

      ]);
    }


    public function mulaikuis($id)
    {

      $data_siswa = Siswa::where('user_id', Auth::user()->id)->first();

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

        $data_siswa = Siswa::where('user_id', Auth::user()->id)->first();

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
        $data_siswa = Siswa::where('user_id', Auth::user()->id)->first();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
     * @param  \App\DataKuis  $dataKuis
     * @return \Illuminate\Http\Response
     */
    public function show(DataKuis $dataKuis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataKuis  $dataKuis
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKuis $dataKuis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataKuis  $dataKuis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataKuis $dataKuis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataKuis  $dataKuis
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKuis $dataKuis)
    {
        //
    }
}
