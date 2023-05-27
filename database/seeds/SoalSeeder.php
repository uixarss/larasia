<?php

use App\Models\JenisUjian;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\Dosen;
use App\Models\Pengampu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create('id_ID');

        JenisUjian::create([
            'kode_jenis_ujian' => Str::random(6),
            'nama_jenis_ujian' => 'Kuis'
        ]);
        JenisUjian::create([
            'kode_jenis_ujian' => Str::random(6),
            'nama_jenis_ujian' => 'UTS'
        ]);
        JenisUjian::create([
            'kode_jenis_ujian' => Str::random(6),
            'nama_jenis_ujian' => 'UAS'
        ]);

        $dibuat_oleh[] = [3, $faker->numberBetween(877, 896)];

        $pengampu = Pengampu::where('id_dosen','=', 1)->first();
        $dosen = Dosen::where('id','=',1)->first();
        $quiz = Quiz::create([
            'mapel_id' => $pengampu->mapel_id,
            'id_prodi' => $pengampu->id_prodi,
            'id_semester' => $pengampu->id_semester,
            'id_tahun_ajaran' => $pengampu->id_tahun_ajaran,
            'kode_soal' => Str::random(5),
            'judul_kuis' => $faker->text(),
            'durasi' => 30,
            'tanggal_mulai' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'tanggal_akhir' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
            'jumlah_soal' => 10,
            'jenisujian_id' => 1,
            'id_dosen' => $pengampu->id_dosen,
            'dibuat_oleh' => $dosen->user_id
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $randomN = $faker->numberBetween(1, 5);
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'pertanyaan' => $faker->text()
            ]);
            for ($j = 1; $j <= 5; $j++) {

                if ($j == $randomN) {
                    $option = Option::create([
                        'question_id' => $question->id,
                        'pilihan_jawaban' => $faker->text(),
                        'is_correct' => true
                    ]);
                } else {
                    $option = Option::create([
                        'question_id' => $question->id,
                        'pilihan_jawaban' => $faker->text(),
                    ]);
                }
            }
        }
    }
}
