<?php

use Illuminate\Database\Seeder;
use App\Models\KalenderAkademik;

class KalenderAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kalender = Kalenderakademik::create([
          'title' => 'Rapat Guru',
          'start' => '2020-04-06 09:00:00',
          'end' => '2020-04-07 09:00:00',
          'color' => '#c40233',
          'deskripsi' => 'Rapat Seluruh Guru dari kelas 10 - 12'
        ]);

        $kalender = Kalenderakademik::create([
          'title' => 'Rapat Orang Tua',
          'start' => '2020-04-10 08:00:00',
          'end' => '2020-04-11 11:00:00',
          'color' => '#29fdf2',
          'deskripsi' => 'Rapat Seluruh Orang Tua dari kelas 10 - 12'
        ]);

    }
}
