<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Models\Siswa;
use App\Models\SiswaDetail;
use App\User;
use Illuminate\Support\Facades\Hash;


class SiswaSeeder extends Seeder
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
        $dataGolDar = ['A', 'B','AB','0'];

        $siswaRole = Role::where('name', 'siswa')->first();

        $faker = Faker\Factory::create('id_ID');

        for($i = 0; $i < 40; $i++) {
            $user = User::create([
                'name' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);
            $user->assignRole($siswaRole->name);
            
            $siswa = Siswa::create([
                'user_id' => $user->id,
                'kelas_id' => $faker->numberBetween($min = 1, $max = 20),
                'nama_depan' => $user->name,
                'nama_belakang' => $faker->lastName,
                'NIS' => $faker->unique()->numberBetween(1000000,10000000),
                'NISN' => $faker->unique()->numberBetween(1000000,10000000),
                'alamat_sekarang' => $faker->address,
                'jenis_kelamin' => $dataJenisKelamin[$faker->numberBetween(0,1)],
                'agama' => $dataAgama[$faker->numberBetween(0,4)],
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'no_phone' => $faker->phoneNumber,
                'kebangsaan' => 'Indonesia',
                'email_siswa' => $user->email,
                'golongan_darah' => $dataGolDar[$faker->numberBetween(0,3)]
            ]);

            $siswa_detail = SiswaDetail::create([
                'siswa_id' => $siswa->id,
                'anak_ke' => $faker->numberBetween(1,3),
                'jumlah_saudara' => $faker->numberBetween(3,5),
                'kondisi_siswa' => 'Cukup',
                'nama_ayah' => $faker->firstNameMale,
                'no_hp_ayah' => $faker->phoneNumber,
                'pendidikan_ayah' => 'Sarjana',
                'pekerjaan_ayah' => 'Pengusaha',
                'penghasilan_ayah' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 26000, $max = 54000),
                'alamat_lengkap_ayah' => $faker->address,
                'nama_ibu' => $faker->firstNameFemale,
                'no_hp_ibu' => $faker->phoneNumber,
                'pendidikan_ibu' => 'Sarjana',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 6000, $max = 14000),
                'alamat_lengkap_ibu' => $faker->address
                
            ]);


        }
        



    }
}
