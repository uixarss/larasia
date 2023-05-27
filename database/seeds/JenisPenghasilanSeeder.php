<?php

use Illuminate\Database\Seeder;
use App\JenisPenghasilan;

class JenisPenghasilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPenghasilan::create([
            'jenis_penghasilan' => '0',
        ]);

        JenisPenghasilan::create([
            'jenis_penghasilan' => '< 1.000.000',
        ]);

        JenisPenghasilan::create([
            'jenis_penghasilan' => '1.000.000-2.000.000',
        ]);

        JenisPenghasilan::create([
            'jenis_penghasilan' => '2.000.000-4.000.000',
        ]);

        JenisPenghasilan::create([
            'jenis_penghasilan' => '4.000.000-6.000.000',
        ]);
        
        JenisPenghasilan::create([
            'jenis_penghasilan' => '>6.000.000',
        ]);
    }
}
