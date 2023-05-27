<?php

use Illuminate\Database\Seeder;
use App\JenisTinggal;

class JenisTinggalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisTinggal::create([
            'jenis_tinggal' => 'Bersama Orangtua',
        ]);

        JenisTinggal::create([
            'jenis_tinggal' => 'Bersama Wali',
        ]);

        JenisTinggal::create([
            'jenis_tinggal' => 'Bersama Saudara',
        ]);

        JenisTinggal::create([
            'jenis_tinggal' => 'Kost',
        ]);
    }
}
