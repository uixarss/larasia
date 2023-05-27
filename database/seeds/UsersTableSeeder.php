<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Models\Siswa;
use App\Models\Pegawai;
use App\Models\DataOrangTua;
use App\Models\Guru;
use App\Models\Dosen;
use App\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAgama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'];
        $dataJenisKelamin = ['L', 'P'];
        $dataStatusPegawai = ['PNS', 'CPNS', 'HONORER'];
        $dataJabatanPegawai = ['Guru', 'Staff'];

        $faker = Faker\Factory::create('id_ID');
        // DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $siswaRole = Role::where('name', 'siswa')->first();
        $orangtuaRole = Role::where('name', 'orangtua')->first();
        $guruRole = Role::where('name', 'dosen')->first();
        $dosenRole = Role::where('name', 'dosen')->first();
        $pegawaiRole = Role::where('name', 'pegawai')->first();
        $waliKelasRole = Role::where('name', 'walikelas')->first();
        $perpustakaanRole = Role::where('name', 'perpustakaan')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('siajaya')
        ]);

        $admin2 = User::create([
            'name' => 'Admin STIKOM',
            'email' => 'admin@kampus.ac.id',
            'password' => Hash::make('siajaya')
        ]);
        // $siswa = User::create([
        //   'name' => 'Siswa User',
        //   'email' => 'siswa@gmail.com',
        //   'password'=> Hash::make('namasaya')
        // ]);

        // $siswa_siswa = Siswa::create([
        //   'kelas_id' => 1,
        //   'user_id' => $siswa->id,
        //   'nama_depan' => $siswa->name,
        //   'NIS' => Str::random(15),
        // ]);


        //   $guru = User::create([
        //     'name' => 'Guru User',
        //     'email' => 'guru@gmail.com',
        //     'password'=> Hash::make('namasaya')
        //   ]);
        //   Guru::create([
        //     'user_id' => $guru->id,
        //     'mapel_id' => $faker->numberBetween(1,9),
        //     'nama_lengkap' => $guru->name,
        //     'NIP' => $faker->unique()->numberBetween(1900000,10000000),
        //     'alamat' => $faker->address,
        //     'jenis_kelamin' => $dataJenisKelamin[$faker->numberBetween(0,1)],
        //     'agama' => $dataAgama[$faker->numberBetween(0,4)],
        //     'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
        //     'email' => $guru->email,
        //     'bagian_pegawai' => 'Akademik',
        //     'status_pegawai' => $dataStatusPegawai[$faker->numberBetween(0,2)],
        //     'jabatan_pegawai' => $dataJabatanPegawai[$faker->numberBetween(0,1)]

        // ]);

        $dosen = User::create([
            'name' => 'Dosen User',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('namasaya')
        ]);
        $dataDosen = ['1,Aktif', '0,Non Aktif'];
        $str_arr2 = explode(",", $dataDosen[$faker->numberBetween(0, 1)]);
        $id_status_aktif = (int)$str_arr2[0];
        $nama_status_aktif = $str_arr2[1];
        Dosen::create([
            'user_id' => $dosen->id,
            'email' => $dosen->email,
            'photo' => null,
            'matkul_id' => $faker->numberBetween(1, 19),
            'nama_dosen' => $dosen->name,
            'tempat_lahir' => $faker->city,
            'tanggal_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'jenis_kelamin' => $dataJenisKelamin[$faker->numberBetween(0, 1)],
            'id_status_aktif' => $id_status_aktif,
            'nama_status_aktif' => $nama_status_aktif,
            'nidn' => $faker->numberBetween(0000000000, 1000000000),
            'nama_ibu' => $faker->firstNameFemale,
            'mampu_handle_kebutuhan_khusus' => $faker->numberBetween(0, 1),
            'mampu_handle_braille' => $faker->numberBetween(0, 1),
            'mampu_handle_bahasa_isyarat' => $faker->numberBetween(0, 1)
        ]);

        $pegawai = User::create([
            'name' => 'Pegawai User',
            'email' => 'pegawai@gmail.com',
            'password' => Hash::make('namasaya')
        ]);

        $pegawai_pegawai = Pegawai::create([
            'user_id' => $pegawai->id,
            'nama_pegawai' => $pegawai->name,
            'email' => $pegawai->email,
            'NIP' => Str::random(15)
        ]);


        // $orangtua = User::create([
        //   'name' => 'Orangtua User',
        //   'email' => 'orangtua@gmail.com',
        //   'password'=> Hash::make('namasaya')
        // ]);

        // $orangtua_orangtua = DataOrangTua::create([
        //   'user_id' => $orangtua->id,
        //   'nama_orangtua' => $orangtua->name,
        //   'siswa_id' => $siswa_siswa->id,
        //   'nama_siswa' => $siswa_siswa->nama_lengkap,
        //   'email_orangtua' => $orangtua->email

        // ]);

        // $walikelas = User::create([
        //   'name' => 'Wali Kelas User',
        //   'email' => 'walikelas@gmail.com',
        //   'password'=> Hash::make('namasaya')
        // ]);

        $perpustakaan = User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'perpus@gmail.com',
            'password' => Hash::make('namasaya')
        ]);

        $admin->assignRole($adminRole->name);
        $admin2->assignRole($adminRole->name);
        // $siswa->assignRole($siswaRole->name);
        // $orangtua->assignRole($orangtuaRole->name);
        // $guru->assignRole($guruRole->name);
        $dosen->assignRole($dosenRole->name);
        $pegawai->assignRole($pegawaiRole->name);
        // $walikelas->assignRole($waliKelasRole->name);
        $perpustakaan->assignRole($perpustakaanRole->name);

        $admin->givePermissionTo(Permission::all());
        $admin2->givePermissionTo(Permission::all());
    }
}
