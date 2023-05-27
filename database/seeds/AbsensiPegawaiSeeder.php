<?php

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\AbsensiPegawai;
use Facade\FlareClient\Time\Time;
use Illuminate\Support\Facades\Date;

class AbsensiPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pegawai = Pegawai::all();
        $data_absensi = ['Alpha', 'Izin', 'Sakit', 'Hadir'];
        $data_jam_masuk = ['06:45', '06:35','06:55'];
        $faker = Faker\Factory::create('id_ID');
        // for ($j = 30; $j > 0; $j--) {

        //     for ($i = 1; $i <= count($pegawai); $i++) {

        //         AbsensiPegawai::create([
        //             'pegawai_id' => $i,
        //             'tanggal_absen' => Date::now()->subDays($j),
        //             'keterangan' => $data_absensi[$faker->numberBetween(0, 2)]
        //         ]);
        //     }
        // }

        for ($i = 1; $i <= count($pegawai); $i++) {

            AbsensiPegawai::create([
                'pegawai_id' => $i,
                'tanggal_absen' => Date::now(),
                'jam_masuk' => $data_jam_masuk[$faker->numberBetween(0,2)],
                'keterangan' => $data_absensi[$faker->numberBetween(1, 3)]
            ]);
        }
    }
}
