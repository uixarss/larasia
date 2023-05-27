<?php

namespace App\Http\Controllers\Admin;

use App\EvaluasiSoal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\ResultQuiz;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class EvaluasiSoalController extends Controller
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
        $data_kuis = Quiz::where('jenisujian_id', '1')->get();
        $data_uts = Quiz::where('jenisujian_id', '2')->get();
        $data_uas = Quiz::where('jenisujian_id', '3')->get();

        return view('admin.evaluasisoal.index', [
          'data_kuis' => $data_kuis,
          'data_uts' => $data_uts,
          'data_uas' => $data_uas
        ]);
    }


    public function detailEvaluasi($id, $id_kelas)
    {
        $quiz = Quiz::where('id', $id)->first();
        $data_questions = $quiz->question;
        $kelas = Kelas::where('id', $id_kelas)->first();

        $data_siswa = Mahasiswa::where('kelas_id', $kelas->id)->get();

        $data_jawaban = [];

        foreach ($data_siswa as $siswa) {
            foreach ($data_questions as $question) {
                $mahasiswa = Mahasiswa::where('user_id', $siswa->user_id)->first();
                $jawaban_benar = Option::where('question_id', $question->id)
                    ->where('is_correct', 1)
                    ->select('id')
                    ->first();


                $jawaban_siswa = Answer::where('siswa_id', $mahasiswa->id)
                    ->where('question_id', $question->id)
                    ->select('option_id', 'jawaban')
                    ->first();


                if ($jawaban_benar != null && $jawaban_siswa != null) {

                    if ($jawaban_siswa->jawaban == "benar") {
                        $data_jawaban_temp = [
                            'siswa_id' => $mahasiswa->id,
                            'question_id' => $question->id,
                            'jawaban_benar' => $jawaban_benar->id,
                            'jawaban_siswa' => $jawaban_siswa->option_id,
                            'score' => 1,
                        ];
                    } else {
                        $data_jawaban_temp = [
                            'siswa_id' => $mahasiswa->id,
                            'question_id' => $question->id,
                            'jawaban_benar' => $jawaban_benar->id,
                            'jawaban_siswa' => $jawaban_siswa->option_id,
                            'score' => 0,
                        ];
                    }
                } else {
                    $data_jawaban_temp = [
                        'siswa_id' => $mahasiswa->id,
                        'question_id' => $question->id,
                        'jawaban_benar' => $jawaban_benar->id ?? '',
                        'jawaban_siswa' => '',
                        'score' => 0,
                    ];
                }

                array_push($data_jawaban, $data_jawaban_temp);

                collect($data_jawaban);
            }
        }

        $nilai_kuis = ResultQuiz::where('quiz_id', $quiz->id)->get();

        // dd($data_jawaban);
        return view('admin.evaluasisoal.detailevaluasi', [
            'quiz' => $quiz,
            'data_questions' => $data_questions,
            'data_siswa' => $data_siswa,
            'kelas' => $kelas,
            'data_jawaban' => $data_jawaban,
            'nilai_kuis' => $nilai_kuis
        ]);
    }



    public function jawaban($question_id, $kelas_id)
    {
        $siswa = Mahasiswa::where('kelas_id', $kelas_id)->select('id')->get();
        $question = Question::find($question_id);
        $jawaban_siswa = Option::join('answers', 'answers.option_id','=' ,'options.id')
                            ->select('options.pilihan_jawaban as option_id', DB::raw('count("answers.option_id") as jumlah'))
                            ->whereIn('answers.siswa_id', $siswa)
                            ->where('answers.question_id','=' ,$question_id)
                            ->groupBy('options.id')
                            ->get();
        $data = [];
        return response()->json($jawaban_siswa);
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
     * @param  \App\EvaluasiSoal  $evaluasiSoal
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluasiSoal $evaluasiSoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EvaluasiSoal  $evaluasiSoal
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluasiSoal $evaluasiSoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvaluasiSoal  $evaluasiSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluasiSoal $evaluasiSoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvaluasiSoal  $evaluasiSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluasiSoal $evaluasiSoal)
    {
        //
    }
}
