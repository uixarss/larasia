<?php

use App\ListRemainder;
use Illuminate\Database\Seeder;

class ListRemainderTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    ListRemainder::create([
      'title' => 'Hari Libur Semester 1',
      'start' => '07:00:00',
      'end' => '08:00:00',
      'color' => '#c40233'
    ]);
    ListRemainder::create([
      'title' => 'Hari Libur Semester 2',
      'start' => '07:00:00',
      'end' => '08:00:00',
      'color' => '#29fdf2'
    ]);
  }
}
