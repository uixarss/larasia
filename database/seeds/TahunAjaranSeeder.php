<?php

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TahunAjaran::create([
            'nama_tahun_ajaran' => '2019/2020',
            'start_date' => '2019-05-15 00:00:00',
            'end_date' => '2020-04-25 23:59:59'
        ]);
        TahunAjaran::create([
            'nama_tahun_ajaran' => '2020/2021',
            'start_date' => '2020-05-15 00:00:00',
            'end_date' => '2021-04-25 23:59:59'
        ]);
    }
}
