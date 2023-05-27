<?php

use Illuminate\Database\Seeder;
use App\Jenjang;

class JenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenjang = Jenjang::create([
            'nama_jenjang' => 'D1',
        ]);

        $jenjang2 = Jenjang::create([
            'nama_jenjang' => 'D2',
        ]);

        $jenjang3 = Jenjang::create([
            'nama_jenjang' => 'D3',
        ]);

        $jenjang4 = Jenjang::create([
            'nama_jenjang' => 'D4',
        ]);

        $jenjang5 = Jenjang::create([
            'nama_jenjang' => 'S1',
        ]);
        
        $jenjang6 = Jenjang::create([
            'nama_jenjang' => 'S2',
        ]);

        $jenjang7 = Jenjang::create([
            'nama_jenjang' => 'S3',
        ]);
    }
}
