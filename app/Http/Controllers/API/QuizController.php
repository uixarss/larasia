<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Siswa;
use App\Models\Mahasiswa;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Answer;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Result;
use App\Models\ResultQuiz;
use App\Models\KelasQuiz;
use Illuminate\Support\Facades\Auth;

class QuizController extends BaseController
{

    public function getSoal(Request $request)
    {
        $quiz = Quiz::where('kode_soal', $request->kode_soal)
            ->first();

        if ($quiz == null) {
            $data['error'] = true;
            $data['message'] = 'Salah kode soal';
            return response()->json($data);
        } else {
            $siswa = Mahasiswa::where('user_id', Auth::id())->first();

            $result = ResultQuiz::where('quiz_id', $quiz->id)
                ->where('siswa_id', $siswa->id)->get();
            
            if ($result->isEmpty()) {

                $quiz = Quiz::where('kode_soal', $request->kode_soal)->first();

                $quiz_kelas = KelasQuiz::where('quiz_id', $quiz->id)->where('kelas_id', $siswa->kelas_id)->first();

                // dd($quiz_kelas);

                if($quiz_kelas){


                $data_question = Question::where('quiz_id', $quiz->id)->with('options')->get();
                $data['error'] = false;
                $data['judul_kuis'] = $quiz->judul_kuis;
                $data['jumlah_soal'] = $quiz->jumlah_soal;
                $data['mata_pelajaran'] = $quiz->mapel->nama_mapel;
                $data['durasi'] = $quiz->durasi;
                $data['data_pertanyaan'] = $data_question;

                // return $this->sendResponse($data, 'Sukses ambil soal');
                return response()->json($data);
                
                }else{

                    $data['error'] = true;
                    $data['message'] = 'Kode salah';
                    return response()->json($data);
           
                }    
            } else {

                $data['error'] = true;
                $data['message'] = 'Sudah mengerjakan kuis';
                return response()->json($data);
            }
        }
    }

    
    public function getAllSoal()
    {
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $quiz = Quiz::join('quiz_kelas', 'quiz_kelas.quiz_id', '=', 'quizzes.id')
            ->where('quiz_kelas.kelas_id', '=', $siswa->id_kelas)
            ->with(['mapel', 'user','result_quizzes'])
            ->withCount('answer')
            ->get();

        

        // return $this->sendResponse($quiz, 'Success');
        return response()->json($quiz);
    }


    public function jawab(Request $request, $id)
    {
        $quiz = Quiz::where('kode_soal', $request->kode_soal)
            ->first();

        $siswa = Mahasiswa::where('user_id', Auth::id())->first();

        $option = Option::find($request->id_option);

        if (Answer::where('quiz_id', $quiz->id) != null) {

            if ($option->is_correct == 1) {
                $nilai = 'benar';
            } else {
                $nilai = 'salah';
            }

            $jawaban = Answer::updateOrCreate(
                [
                    // baru
                    'quiz_id' => $quiz->id,
                    'question_id' => $request->id_question,
                    'siswa_id' => $siswa->id,
                ],
                [
                    //update
                    'option_id' => $request->id_option,
                    'jawaban' => $nilai
                ]
            );
        }

        return response()->json($jawaban);
    }

    public function ambilJawaban(Request $request)
    {
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $quiz = Quiz::where('kode_soal', $request->kode_soal)
            ->first();
        $data_jawaban = Answer::where('quiz_id', $quiz->id)
            ->where('siswa_id', $siswa->id)
            ->get();
        return response()->json($data_jawaban);
    }

    public function simpanHasilJawaban(Request $request)
    {
        $quiz = Quiz::where('kode_soal', $request->kode_soal)
        ->first();

        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        $jumlah_soal = $quiz->jumlah_soal;

        $jawaban = Answer::where('quiz_id', $quiz->id)
            ->where('siswa_id','=', $siswa->id)
            ->where('jawaban', '=','benar')->count();


        
        $simpanHasilJawaban = new ResultQuiz;

        $count = $simpanHasilJawaban->where(['siswa_id' => $siswa->id, 'quiz_id' => $quiz->id])->count();
        if ($count > 0) {
            $result = $simpanHasilJawaban->where(['siswa_id' => $siswa->id, 'quiz_id' => $quiz->id])->get();
            return response()->json($result);
        }
        $simpanHasilJawaban->siswa_id = $siswa->id;
        $simpanHasilJawaban->quiz_id = $quiz->id;
        $simpanHasilJawaban->nilai_akhir = ($jawaban / $jumlah_soal) * 100;
        $simpanHasilJawaban->save();

        return response()->json($simpanHasilJawaban);


    }

    public function listKuis()
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $quiz = Quiz::where('id_dosen', $dosen->id)
        ->where('id_tahun_ajaran', $tahun_ajaran->id)
        ->where('id_semester', $semester->id)->get();

        return response()->json($quiz);
    }

    public function listKuisKelas(Request $request) 
    {
        $quiz = Quiz::where('kode_soal', $request->kode_soal)->first();

        $kelas = $quiz->kelas;

        return response()->json($kelas);
    }

    public function detailKuisKelas(Request $request)
    {
        $data = [];
        $kuis = Quiz::where('kode_soal', $request->kode_soal)->first();
        $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();
        // $data_siswa = Siswa::where('kelas_id', $kelas->id)->get();

        $data_siswa = Mahasiswa::where('kelas_id', $kelas->id)->get('id');

        $result = ResultQuiz::where('quiz_id', $kuis->id)->whereIn('siswa_id', $data_siswa)->get();

        foreach ($data_siswa as $siswa ) {
            $mahasiswa = Mahasiswa::find($siswa->id);
            if ($result->where('siswa_id', $siswa->id)->count() > 0) {
                $data2 = [
                    'id' => $siswa->id,
                    'nama_siswa' => $mahasiswa->nama_mahasiswa,
                    'status' => 'sudah'
                ];
                array_push($data, $data2);
            } else {
                $data2 = [
                    'id' => $siswa->id,
                    'nama_siswa' => $mahasiswa->nama_mahasiswa,
                    'status' => 'belum'
                ];
                array_push($data, $data2);
            }
        }

        return response()->json($data);
    }

    public function checkQuiz(Request $request){
        
        $quiz = Quiz::where('kode_soal', $request->kode_soal)
            ->first();
        // dd($quiz);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        $check = ResultQuiz::where('quiz_id', $quiz->id)
                            ->where('siswa_id', $mahasiswa->id)
                            ->first();
        if($check){
            $success['status'] = 1;
        }else{
            $success['status'] = 0;
        }

        return response()->json($success);

    }

    
}
