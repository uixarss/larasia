<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $dataAgama = ['Islam', 'Kristen', 'Katolik', 'Hindu','Budha'];
        $dataJenisKelamin = ['L','P'];
        $dataStatusPegawai = ['PNS','CPNS','HONORER'];


        $pegawaiRole = Role::where('name', 'pegawai')->first();

        $faker = Faker\Factory::create('id_ID');

        for($i = 0; $i < 20; $i++) {

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);
            $user->roles()->attach($pegawaiRole);
            
            $pegawai = Pegawai::create([
                'user_id' => $user->id,
                'nama_pegawai' => $user->name,
                'NIP' => $faker->unique()->numberBetween(1900000,10000000),
                'alamat' => $faker->address,
                'jenis_kelamin' => $dataJenisKelamin[$faker->numberBetween(0,1)],
                'agama' => $dataAgama[$faker->numberBetween(0,4)],
                'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'email' => $user->email,
                'bagian_pegawai' => 'Non Akademik',
                'status_pegawai' => $dataStatusPegawai[$faker->numberBetween(0,2)],
                'jabatan_pegawai' => 'Staff'

            ]);

        }


    }
}
