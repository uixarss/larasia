<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use App\Models\AbsensiSiswa;
use App\Models\Siswa;

class AbsensiSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_siswa = Siswa::all();
        $data_absensi = ['Alpha', 'Izin', 'Sakit', 'Hadir'];
        $data_jam_masuk = ['06:45', '06:35', '06:55'];
        $data_jam_pulang = ['13:35', '13:30', '14:25'];

        $faker = Faker\Factory::create('id_ID');

        for ($j = 66; $j > 0; $j--) {

            for ($i = 1; $i <= count($data_siswa); $i++) {

                AbsensiSiswa::create([
                    'siswa_id' => $i,
                    'tanggal_absen' => Date::now()->subDays($j),
                    'jam_masuk' => $data_jam_masuk[$faker->numberBetween(0, 2)],
                    'jam_pulang' => $data_jam_pulang[$faker->numberBetween(0, 2)],
                    'keterangan' => $data_absensi[$faker->numberBetween(0, 2)]
                ]);
            }
        }

        for ($i = 1; $i <= count($data_siswa); $i++) {

            AbsensiSiswa::create([
                'siswa_id' => $i,
                'tanggal_absen' => Date::now(),
                'jam_masuk' => $data_jam_masuk[$faker->numberBetween(0, 2)],
                'jam_pulang' => $data_jam_pulang[$faker->numberBetween(0, 2)],
                'keterangan' => $data_absensi[$faker->numberBetween(1, 3)]
            ]);
        }

        for ($i = 1; $i <= 66; $i++) {
            foreach ($data_siswa as $key_siswa => $siswa) {
                $siswa->absensis()->create([
                    'absensiable_id' => $siswa->id,
                    'absensiable_type' => Siswa::class,
                    'tanggal_absen' => Date::now()->subDays($i),
                    'jam_masuk' => $data_jam_masuk[$faker->numberBetween(0, 2)],
                    'jam_pulang' => $data_jam_pulang[$faker->numberBetween(0, 2)],
                    'keterangan' => $data_absensi[$faker->numberBetween(1, 3)]

                ]);
            }
        }

        foreach ($data_siswa as $key_siswa => $siswa) {
            $siswa->absensis()->create([
                'absensiable_id' => $siswa->id,
                'absensiable_type' => Siswa::class,
                'tanggal_absen' => Date::now(),
                'jam_masuk' => $data_jam_masuk[$faker->numberBetween(0, 2)],
                'jam_pulang' => $data_jam_pulang[$faker->numberBetween(0, 2)],
                'keterangan' => $data_absensi[$faker->numberBetween(1, 3)]

            ]);
        }
    }
}
