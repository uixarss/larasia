<?php

use Illuminate\Database\Seeder;
use App\Lembaga;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lembaga::create([
            'nama_lembaga'=> 'Yayasan'
        ]);

        Lembaga::create([
            'nama_lembaga'=> 'Kementerian'
        ]);

        Lembaga::create([
            'nama_lembaga'=> 'Pemerintah Provinsi'
        ]);

        Lembaga::create([
            'nama_lembaga'=> 'Pemerintah Pusat'
        ]);
    }
}
