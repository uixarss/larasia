<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'title' => 'Rapat Guru',
            'start' => '2020-04-06 09:00:00',
            'end' => '2020-04-07 09:00:00',
            'color' => '#c40233',
            'description' => 'Rapat Seluruh Guru dari kelas 10 - 12'
        ]);

        Event::create([
            'title' => 'Rapat Orang Tua',
            'start' => '2020-04-10 08:00:00',
            'end' => '2020-04-11 11:00:00',
            'color' => '#29fdf2',
            'description' => 'Rapat Seluruh Orang Tua dari kelas 10 - 12'
        ]);
    }
}
