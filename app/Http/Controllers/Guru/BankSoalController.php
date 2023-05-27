<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Kelas;
use App\Models\Option;
use App\Models\JenisUjian;
use App\Models\MataPelajaran;
use App\Models\Tugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BankSoalController extends Controller
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
          // if (Gate::denies('view-soal')) {
          //   abort(403, 'User does not have the right permissions.');
          // }
          $jenis_soal = JenisUjian::all();

          // $data_quiz = Quiz::all();
          $bankSoal_data_quiz = Quiz::where('jenisujian_id','1')->with('quiz')->cursor();
          $bankSoal_data_uts = Quiz::where('jenisujian_id','2')->with('quiz')->cursor();
          $bankSoal_data_uas = Quiz::where('jenisujian_id','3')->with('quiz')->cursor();


          $data_kelas = Kelas::all();

          $guru = Dosen::where('user_id', Auth::user()->id)->first();

          $pengampu = Pengampu::where('id_dosen', $guru->id)->first();

          $mapel = Pengampu::join('mapel', 'pengampu.mapel_id','=','mapel.id')
                ->where('id_dosen', $guru->id)->groupBy('nama_mapel')->get();
          

          if($guru){
              $data_quiz = Quiz::where('id_dosen', $guru->id)
              ->where('jenisujian_id','1')->with('quiz')->cursor();
              $data_uts = Quiz::where('id_dosen', $guru->id)
              ->where('jenisujian_id','2')->with('quiz')->cursor();
              $data_uas = Quiz::where('id_dosen', $guru->id)
              ->where('jenisujian_id','3')->with('quiz')->cursor();
          }

          
        $jumlahQuiz = count($data_quiz);


          return view('guru.banksoal.index', [
            'data_quiz' => $data_quiz,
            'data_uts' => $data_uts,
            'data_uas' => $data_uas,
            'bankSoal_data_quiz' => $bankSoal_data_quiz,
            'bankSoal_data_uts' => $bankSoal_data_uts,
            'bankSoal_data_uas' => $bankSoal_data_uas,
            'data_kelas' => $data_kelas,
            'jenis_soal' => $jenis_soal,
            'guru' => $pengampu,
            'mapel' => $mapel,
            'jumlah_quiz' =>$jumlahQuiz
          ]);
    }



    public function detailsoal($id)
    {
      // if (Gate::denies('edit-soal')) {
      //   abort(403, 'User does not have the right permissions.');
      // }
      //where kuis id, id
      $data_quiz = Quiz::find($id);

      $data_question = Question::where('quiz_id', $data_quiz->id)->get();

      $data_option = Option::where('question_id', $data_quiz->id)->first();

      $data_answer = Answer::where('data_option', $data_quiz->id);

      return view('guru.banksoal.detailsoal', [

        'data_quiz' => $data_quiz,
        'data_question' => $data_question,
        'data_option' => $data_option,
        'data_answer' => $data_answer

      ]);
    }




    public function viewQuestion(Request $request)
    {
        $data_question =  Question::where([
            'id' => $request->id,
            'quiz_id' => $request->quiz_id,
            'pertanyaan' => $request->pertanyaan
        ]);

        return redirect()->back();
    }



    public function createQuestions(Request $request, $id)
    {
        // if (Gate::denies('create-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        $data_question =  Question::create([
            'quiz_id' => $request->quiz_id,
            'pertanyaan' => $request->pertanyaan
        ]);

        $data_quiz = Quiz::find($id);

        $data_quiz->update([
          'jumlah_soal' => $request->jmlh_quiz
        ]);

        return $request->all();
    }


    public function deleteQuestion(Request $request, $id)
    {
        // if (Gate::denies('delete-soal')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        Question::where('id', $request->id)->delete();
        return $request->all();

        $data_quiz = Quiz::find($id);

        $data_quiz->update([
          'jumlah_soal' => $request->jmlh_quiz
        ]);

        return $request->all();
    }


    public function updateQuestion(Request $request)
    {
        // if (Gate::denies('update-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        $data_question = Question::find($request->id);

        $data_question->update([
          'id' => $request->id,
          'quiz_id' => $request->quiz_id,
          'pertanyaan' => $request->pertanyaan
        ]);


        return $request->all();
    }






    public function createOption(Request $request)
    {
        // if (Gate::denies('manage-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        $data_option =  Option::create([
            'question_id' => $request->question_id,
            'pilihan_jawaban' => $request->pilihan_jawaban,
            'is_correct' => 0
        ]);


        return response()->json($data_option);
    }


    public function deleteOption(Request $request)
    {
        // if (Gate::denies('manage-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        Option::where('id', $request->id)->delete();
        return $request->all();
    }


    public function updateOption(Request $request)
    {
        // if (Gate::denies('manage-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        $data_option = Option::find($request->id);

        $data_option->update([
          'pilihan_jawaban' => $request->value
        ]);

        return $request->all();
    }


    public function updateOptionAnswer(Request $request)
    {
        // if (Gate::denies('manage-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        $data_option = Option::find($request->id);

        if ($request->benar == 0) {
          $data_option->update([
            'pilihan_jawaban' => $request->value,
            'is_correct' => $request->salah
          ]);
        }else {
          $data_option->update([
            'pilihan_jawaban' => $request->value,
            'is_correct' => $request->benar
            ]);
        }


        return $data_option;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
      // if (Gate::denies('update-soal')) {
      //   abort(403, 'User does not have the right permissions.');
      // }
        $data_guru = Dosen::where('user_id', Auth::user()->id)->first();

        $data_quiz =  Quiz::create([
            'mapel_id' => $request->mapel_id,
            'id_prodi' => $request->id_prodi,
            'id_semester' => $request->id_semester,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'kode_soal' => $request->kode_soal,
            'judul_kuis' => $request->judul_kuis,
            'jumlah_soal' => 0,
            'durasi' => $request->durasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'id_dosen' => $data_guru->id,
            'dibuat_oleh' => Auth::id(),
            'jenisujian_id' => $request->jenis_soal
        ]);

        $data_quiz->kelas()->attach($request->id_kelas);

        return redirect()->route('guru.banksoal.edit', $data_quiz->id )->with('sukses', 'Data Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          // if (Gate::denies('view-soal')) {
          //   abort(403, 'User does not have the right permissions.');
          // }
          $data_quiz = Quiz::find($id);

          $data_question = Question::where('quiz_id', $data_quiz->id)->get();

          $data_option = Option::where('question_id', $data_quiz->id)->first();

          return view('guru.banksoal.show',[

            'data_quiz' => $data_quiz,
            'data_question' => $data_question,
            'data_option' => $data_option

          ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (Gate::denies('edit-soal')) {
        //   abort(403, 'User does not have the right permissions.');
        // }
        $data_quiz = Quiz::find($id);

        $data_question = Question::where('quiz_id', $data_quiz->id)->get();

        $data_option = Option::where('question_id', $data_quiz->id)->first();

        return view('guru.banksoal.edit', compact('data_quiz', 'data_question', 'data_option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      // if (Gate::denies('update-soal')) {
      //   abort(403, 'User does not have the right permissions.');
      // }
      $data_guru = Dosen::where('user_id', Auth::user()->id)->first();
      $data_quiz = Quiz::find($id);

      $data_quiz->update([
          'mapel_id' => $request->mapel_id,
          'id_prodi' => $request->id_prodi,
          'id_semester' => $request->id_semester,
          'id_tahun_ajaran' => $request->id_tahun_ajaran,
          'kode_soal' => $request->kode_soal,
          'judul_kuis' => $request->judul_kuis,
          // 'jumlah_soal' => 0,
          'durasi' => $request->durasi,
          'tanggal_mulai' => $request->tanggal_mulai,
          'tanggal_akhir' => $request->tanggal_akhir,
          'id_dosen' => $data_guru->id,
          'dibuat_oleh' => Auth::id(),
          // 'jenisujian_id' => $request->jenis_soal
      ]);

      $data_quiz->kelas()->sync($request->id_kelas);

      return back();


    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankSoal  $bankSoal
     * @return \Illuminate\Http\Response
     */
    public function destroyTugas($id)
    {



    }

    public function destroy($id)
    {
      // if (Gate::denies('delete-soal')) {
      //   abort(403, 'User does not have the right permissions.');
      // }
      $data_quiz = Quiz::find($id);
      $data_quiz->delete($data_quiz);
      return redirect()->route('guru.banksoal.index');
    }
}
