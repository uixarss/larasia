<?php

use App\Models\Kkm;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class KkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_mapel = MataPelajaran::all();

        foreach ($data_mapel as $mapel ) {
            Kkm::create([
                'mapel_id' => $mapel->id,
                'nilai' => 75
            ]);
        }
    }
}
