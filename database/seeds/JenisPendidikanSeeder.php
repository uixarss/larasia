<?php

use Illuminate\Database\Seeder;
use App\JenisPendidikan;

class JenisPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPendidikan::create([
            'jenis_pendidikan' => 'Tidak Sekolah',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'Tidak Tamat SD/MI',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'SD/MI',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'SMP/MTs',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'SMA/MA/SMK',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'Diploma',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'S1',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'S2',
        ]);

        JenisPendidikan::create([
            'jenis_pendidikan' => 'S3',
        ]);
    }
}
