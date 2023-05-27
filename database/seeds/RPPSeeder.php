<?php

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Rpp;

class RPPSeeder extends Seeder
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
        $data_guru = Guru::all();

        foreach ($data_guru as $guru) {

            for ($i = 1; $i < 10; $i++) {
                Rpp::create([
                    'id_rpp' => $faker->numberBetween(10000,99999),
                    'bab' => $faker->name(),
                    'judul' => $faker->text,
                    'deskripsi' => $faker->realText(),
                    'created_by' => $guru->user_id

                ]);
            }
        }
    }
}
