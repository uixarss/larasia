<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Models\Dosen;
use App\Role;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAgama = ['1,Islam', '2,Kristen', '3,Katolik', '4,Hindu','5,Budha'];
        $dataDosen = ['1,Aktif', '0,Non Aktif'];
        
        $dataJenisKelamin = ['L','P'];

        $faker = Faker\Factory::create('id_ID');

        $guruRole = Role::where('name', 'dosen')->first();

        for($i = 0; $i < 30; $i++) {
            
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);

            $str_arr = explode (",", $dataAgama[$faker->numberBetween(0,4)]); 
            $int = (integer)$str_arr[0];
            $id_agama = $int;
            $nama_agama= $str_arr[1];

            $str_arr2 = explode (",", $dataDosen[$faker->numberBetween(0,1)]); 
            $id_status_aktif = (integer)$str_arr2[0];
            $nama_status_aktif= $str_arr2[1];
            
            $user->roles()->attach($guruRole);

            $dosen = Dosen::create([
                
            'user_id' => $user->id,
            'photo' => null,
            'matkul_id' => null,
            'nama_dosen' => $user->name,
            'tempat_lahir' => $faker->city,
            'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'jenis_kelamin' => $dataJenisKelamin[$faker->numberBetween(0, 1)],
            'id_agama' => $id_agama,
            'nama_agama' => $nama_agama,
            'id_status_aktif' => $id_status_aktif,
            'nama_status_aktif'=> $nama_status_aktif,
            'nidn' => $faker->numberBetween(0000000000,1000000000),
            'nama_ibu' => $faker->firstNameFemale,
            'nik' => null,
            'nip' => null,
            'npwp' => null,
            'id_jenis_sdm' => null,
            'nama_jenis_sdm' => null,
            'no_sk_cpns' => null,
            'tanggal_sk_cpns' => null,
            'no_sk_pengangkatan' => null,
            'mulai_sk_pengangkatan' => null,
            'id_lembaga_pengangkatan'=> null,
            'nama_lembaga_pengangkatan'=> null,
            'id_pangkat_golongan' => null,
            'nama_pangkat_golongan'=> null,
            'id_sumber_gaji' => null,
            'nama_sumber_gaji' => null,
            // 'jalan' => null,
            // 'dusun' => null,
            // 'rt',
            // 'rw',
            // 'ds_kel',
            // 'kode_pos',
            // 'id_wilayah',
            // 'nama_wilayah',
            // 'id_kecamatan',
            // 'nama_kecamatan',
            // 'telepon',
            // 'handphone',
            'email' => $user->email,
            // 'status_pernikahan',
            // 'nama_suami_istri',
            // 'nip_suami_istri',
            // 'tanggal_mulai_pns',
            // 'id_pekerjaan_suami_istri',
            // 'nama_pekerjaan_suami_istri',
            'mampu_handle_kebutuhan_khusus' => $faker->numberBetween(0,1),
            'mampu_handle_braille' => $faker->numberBetween(0,1),
            'mampu_handle_bahasa_isyarat' => $faker->numberBetween(0,1)
            ]);

        }
    }
}
