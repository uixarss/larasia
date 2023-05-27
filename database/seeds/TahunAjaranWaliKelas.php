<?php

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranWaliKelas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data_kelas = Kelas::all();
        $data_tahun_ajaran = TahunAjaran::all();

        $faker = Faker\Factory::create('id_ID');

        for ($i = 1; $i <= count($data_kelas); $i++) {

            for ($j = 1; $j <= count($data_tahun_ajaran); $j++) {

                DB::table('tahun_ajaran_guru_kelas')->insert([
                    'kelas_id' => $i,
                    'guru_id' => $faker->numberBetween(1,20),
                    'tahun_ajaran_id' => $j,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
