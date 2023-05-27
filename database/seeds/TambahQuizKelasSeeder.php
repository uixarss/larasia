<?php

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TambahQuizKelasSeeder extends Seeder
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

        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            DB::table('quiz_kelas')->insert([
                'quiz_id' => $quiz->id,
                'kelas_id' => $faker->numberBetween(1,20)
            ]);
        }
    }
}
