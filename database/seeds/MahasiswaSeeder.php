<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Role;
use App\User;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAgama = ['1,Islam', '2,Kristen', '3,Katolik', '4,Hindu','5,Budha'];
        $dataMahasiswa = ['1,Aktif', '0,Non Aktif'];
        
        $dataJenisKelamin = ['L','P'];

        $faker = Faker\Factory::create('id_ID');

        $siswaRole = Role::where('name', 'mahasiswa')->first();

        for($i = 0; $i < 200; $i++) {
            
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);

            $str_arr = explode (",", $dataAgama[$faker->numberBetween(0,4)]); 
            $int = (integer)$str_arr[0];
            $id_agama = $int;
            $nama_agama= $str_arr[1];

            $str_arr2 = explode (",", $dataMahasiswa[$faker->numberBetween(0,1)]); 
            $int2 = (integer)$str_arr2[0];
            $id_status_mahasiswa = $int2;
            $nama_status_mahasiswa= $str_arr2[1];
            
            $user->roles()->attach($siswaRole);

            $mahasiswa = Mahasiswa::create([
                'nim' => $faker->unique()->numberBetween(1000000,10000000),
                'user_id' => $user->id, 
                'photo' => null, 
                'nama_mahasiswa' => $user->name,
                'id_prodi' => $faker->numberBetween(1,6),
                'angkatan' => $faker->numberBetween(2012, 2019),
                'kelas_id' => $faker->numberBetween($min = 1, $max = 20),
                'jenis_kelamin'=> $dataJenisKelamin[$faker->numberBetween(0,1)],
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'id_agama' => $id_agama,
                'nama_agama' => $nama_agama,
                'nik' => $faker->unique()->numberBetween(3000000000000000,4000000000000000),
                'nisn' => $faker->unique()->numberBetween(1000000,10000000),
                // 'npwp' => null,
                'id_negara' => 'ID',
                'kewarganegaraan' => 'Indonesia',
                // 'jalan' => null,
                // 'dusun' => null,
                // 'rt' => null,
                // 'rw' => null,
                // 'kelurahan' => null,
                'kode_pos'=> $faker->unique()->numberBetween(10000,99999),
                // 'id_wilayah' => null,
                // 'nama_wilayah' => null,
                // 'id_jenis_tinggal' => null,
                // 'nama_jenis_tinggal' => null,
                // 'id_alat_transportasi' => null,
                // 'nama_alat_transportasi' => null,
                // 'telepon' => null,
                // 'handphone' => null,
                'email' => $user->email,
                // 'penerima_kps' => null,
                // 'nomor_kps' => null,
                // 'nik_ayah'=> null,
                // 'nama_ayah'=> null,
                // 'tanggal_lahir_ayah' => null,
                // 'id_pendidikan_ayah' => null,
                // 'nama_pendidikan_ayah' => null,
                // 'id_pekerjaan_ayah' => null,
                // 'nama_pekerjaan_ayah' => null,
                // 'id_penghasilan_ayah' => null,
                // 'nama_penghasilan_ayah' => null,
                'nik_ibu' => $faker->unique()->numberBetween(3000000000000000,4000000000000000),
                'nama_ibu' => $faker->firstNameFemale,
                'tanggal_lahir_ibu' => $faker->dateTimeThisCentury->format('Y-m-d'),
                // 'id_pendidikan_ibu' => null,
                // 'nama_pendidikan_ibu' => null,
                // 'id_pekerjaan_ibu' => null,
                // 'nama_pekerjaan_ibu' => null,
                // 'id_penghasilan_ibu' => null,
                // 'nama_penghasilan_ibu' => null,
                // 'nama_wali' => null,
                // 'tanggal_lahir_wali' => null,
                // 'id_pendidikan_wali'=> null,
                // 'nama_pendidikan_wali'=> null,
                // 'id_pekerjaan_wali'=> null,
                // 'nama_pekerjaan_wali'=> null,
                // 'id_penghasilan_wali'=> null,
                // 'nama_penghasilan_wali'=> null,
                // 'id_kebutuhan_khusus_mahasiswa' => null,
                // 'nama_kebutuhan_khusus_mahasiswa' => null,
                // 'id_kebutuhan_khusus_ayah' => null,
                // 'nama_kebutuhan_khusus_ayah' => null,
                // 'id_kebutuhan_khusus_ibu' => null,
                // 'nama_kebutuhan_khusus_ibu' => null,
                'id_status_mahasiswa' => $id_status_mahasiswa,
                'nama_status_mahasiswa'=> $nama_status_mahasiswa
            ]);

        }
    }
}
