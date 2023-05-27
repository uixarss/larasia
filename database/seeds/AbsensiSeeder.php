<?php

use Illuminate\Database\Seeder;
use App\Models\Absensi;
use App\Models\User;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::where('name','Guru User')->first();


        $faker = Faker\Factory::create('id_ID');

        for ($i=1; $i <= 60; $i++) { 
            Absensi::create([
                'user_id' => $user->id,
                'hari_absen' => $faker->day,
                'siswa_id' => $i,
                'kelas_id' => $faker->numberBetween(1,20),
                'nama_tagihan' => 'SPP Maret 2020',
                'deadline' => '2020-03-31 16:00:00',
                'jumlah_tagihan' => 125000,
                'status' => 'BELUM LUNAS'
            ]);
        }
    }
}
