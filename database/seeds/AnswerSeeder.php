<?php

use App\Models\Answer;
use App\Models\Kelas;
use App\Models\Quiz;
use App\Models\Siswa;
use App\Models\ResultQuiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $kelas = Kelas::find(1);
        $data_siswa = Siswa::where('kelas_id', $kelas->id)->get();

        $quiz = Quiz::find(1);

        $data_question = $quiz->question;

        //jawab random
        foreach ($data_siswa as $siswa) {
            foreach ($data_question as $question) {

                $jawaban_benar = $question->options->where('is_correct', 1)->first();

                $pilih_jawaban = DB::table('options')->where('question_id', $question->id)->inRandomOrder()->first();

                if ($jawaban_benar == null) {
                    Answer::create([
                        'quiz_id' => $quiz->id,
                        'question_id' => $question->id,
                        'option_id' => $pilih_jawaban->id,
                        'siswa_id' => $siswa->id,
                        'jawaban' => 'salah'
                    ]);
                } else {

                    if ($jawaban_benar->id == $pilih_jawaban->id) {
                        Answer::create([
                            'quiz_id' => $quiz->id,
                            'question_id' => $question->id,
                            'option_id' => $pilih_jawaban->id,
                            'siswa_id' => $siswa->id,
                            'jawaban' => 'benar'
                        ]);
                    } else {
                        Answer::create([
                            'quiz_id' => $quiz->id,
                            'question_id' => $question->id,
                            'option_id' => $pilih_jawaban->id,
                            'siswa_id' => $siswa->id,
                            'jawaban' => 'salah'
                        ]);
                    }
                }
            }
        }

        // result quiz
        foreach ($data_siswa as $siswa) {
            $jumlah_soal = $quiz->jumlah_soal;

            $jawaban = Answer::where('quiz_id', $quiz->id)
                ->where('siswa_id', '=', $siswa->id)
                ->where('jawaban', '=', 'benar')->count();



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
        }
    }
}
