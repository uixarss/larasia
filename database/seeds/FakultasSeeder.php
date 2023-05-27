<?php

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fakultas::create([
            'kode_fakultas' => 'TEKNIK',
            'nama_fakultas'=> 'Teknik'
        ]);

        Fakultas::create([
            'kode_fakultas' => 'PERAIRAN',
            'nama_fakultas'=> 'Perairan'
        ]);

        Fakultas::create([
            'kode_fakultas' => 'BAHASA',
            'nama_fakultas'=> 'Ilmu Bahasa'
        ]);

        
        Fakultas::create([
            'kode_fakultas' => 'HUKUM',
            'nama_fakultas'=> 'Hukum'
        ]);
    }
}
