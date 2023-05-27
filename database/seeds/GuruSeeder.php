<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataAgama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'];
        $dataJenisKelamin = ['L', 'P'];
        $dataStatusPegawai = ['PNS', 'CPNS', 'HONORER'];
        $dataJabatanPegawai = ['Guru', 'Staff'];


        $guruRole = Role::where('name', 'dosen')->first();

        $faker = Faker\Factory::create('id_ID');

        for($i = 0; $i < 57; $i++) {

            $id_mapel_fake = $faker->numberBetween(1,19);

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);
            $user->roles()->attach($guruRole);

            if (Guru::where('mapel_id', $id_mapel_fake)->count() > 2) {
                $id_mapel_fake = $faker->numberBetween(1, 19);
            }

            $pegawai = Guru::create([
                'user_id' => $user->id,
                'mapel_id' => $id_mapel_fake,
                'nama_lengkap' => $user->name,
                'NIP' => $faker->unique()->numberBetween(1900000, 10000000),
                'alamat' => $faker->address,
                'jenis_kelamin' => $dataJenisKelamin[$faker->numberBetween(0, 1)],
                'agama' => $dataAgama[$faker->numberBetween(0, 4)],
                'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'email' => $user->email,
                'bagian_pegawai' => 'Akademik',
                'status_pegawai' => $dataStatusPegawai[$faker->numberBetween(0, 2)],
                'jabatan_pegawai' => $dataJabatanPegawai[$faker->numberBetween(0, 1)]

            ]);
        }
    }
}
