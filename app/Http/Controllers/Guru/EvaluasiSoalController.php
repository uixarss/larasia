<?php

namespace App\Http\Controllers\Guru;

use App\EvaluasiSoal;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Dosen;
use App\Models\ResultQuiz;
use App\Models\Siswa;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Gate;

class EvaluasiSoalController extends Controller
{
    protected $id_kuis;
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
        //     abort(403, 'User does not have the right permissions.');
        // }
        $data_kelas = Kelas::all();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $data_kuis = Quiz::where('id_dosen', $dosen->id)->get();

        return view('guru.evaluasisoal.index', [
            'data_kelas' => $data_kelas,
            'data_kuis' => $data_kuis
        ]);
    }

    /**
     * Ambil data kelas ajax
     */

    public function ambilKelas(Request $request)
    {
        
        $quiz = Quiz::find($request->kuis_id);
        $this->kode_soal = $quiz->kode_soal;
        $kelas = $quiz->kelas;

        return DataTables::of($kelas)
            ->addColumn('kelas', function ($kelas) {
                if ($kelas) {
                    return $kelas->nama_kelas;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('action', function ($kelas) {
                if ($kelas) {
                    return '<div>
                <a href="evaluasisoal/kuis/' . $this->kode_soal . '/kelas/' . $kelas->kode_kelas . '" class="btn btn-sm btn-success">Detail</a>
              </div>';
                } else {
                    return 'no data';
                }
            })
            ->make(true);
    }

    /**
     * Detail Kuis berdasarkan kelas
     * 
     */

    public function detailKelas($kode_soal, $kode_kelas)
    {
        // if (Gate::denies('edit-soal')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $quiz = Quiz::where('kode_soal', $kode_soal)->first();

        $data_questions = $quiz->question;
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->first();
        $data_siswa = Mahasiswa::where('kelas_id', $kelas->id)
            // ->select('id')
            ->get();

        $data_jawaban = [];

        foreach ($data_siswa as $siswa) {
            $mahasiswa = Mahasiswa::where('user_id', $siswa->user_id)->first();
            foreach ($data_questions as $question) {
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

        return view('guru.evaluasisoal.detailevaluasi', [
            'quiz' => $quiz,
            'data_questions' => $data_questions,
            'data_siswa' => $data_siswa,
            'kelas' => $kelas,
            'data_jawaban' => $data_jawaban,
            'nilai_kuis' => $nilai_kuis
        ]);
    }

    /**
     * Mengambil jawaban untuk grafik evaluasi soal
     * 
     */

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
