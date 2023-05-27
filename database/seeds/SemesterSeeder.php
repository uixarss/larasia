<?php

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Semester::create([
            'nama_semester' => 'GANJIL',
            // 'tahun_ajaran_id' => 1
        ]);
        Semester::create([
            'nama_semester' => 'GENAP',
            // 'tahun_ajaran_id' => 1,
        ]);


    }
}
