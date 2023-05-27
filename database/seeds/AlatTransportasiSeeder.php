<?php

use Illuminate\Database\Seeder;
use App\AlatTransportasi;

class AlatTransportasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AlatTransportasi::create([
            'alat_transportasi' => 'Jalan Kaki',
        ]);

        AlatTransportasi::create([
            'alat_transportasi' => 'Motor',
        ]);

        AlatTransportasi::create([
            'alat_transportasi' => 'Mobil',
        ]);

        AlatTransportasi::create([
            'alat_transportasi' => 'Angkutan Umum',
        ]);

        AlatTransportasi::create([
            'alat_transportasi' => 'Lainnya',
        ]);

    }
}
