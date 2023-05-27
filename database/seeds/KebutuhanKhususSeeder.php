<?php

use Illuminate\Database\Seeder;
use App\KebutuhanKhusus;

class KebutuhanKhususSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Tidak',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Netra',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Rungu',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Grahita Ringan',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Grahita Sedang',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Daksa Ringan',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Daksa Sedang',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Laras',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Wicara',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Tuna Ganda',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Hiper Aktif',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Cerdas istimewa',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Bakat Istimewa',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Kesulitan Belajar',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Narkoba',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Indigo',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Down Sindrome',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Autis',
        ]);

        KebutuhanKhusus::create([
            'kebutuhan_khusus' => 'Lainnya',
        ]);

    }
}
