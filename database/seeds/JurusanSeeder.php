<?php

use App\Models\Jurusan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        //
        // factory(App\Kelas::class, 50)->create()->each(function ($kelas) {
        //     // $user->posts()->save(factory(App\Post::class)->make());
        //     $kelas->make();
        // });
        Jurusan::create([
            'id_fakultas'=> 1,
            'kode_jurusan' => 'TM',
            'nama_jurusan' => 'Teknik Mesin'
        ]);

        Jurusan::create([
            'id_fakultas'=> 1,
            'kode_jurusan' => 'TK',
            'nama_jurusan' => 'Teknik Kimia'
        ]);

        Jurusan::create([
            'id_fakultas'=> 2,
            'kode_jurusan' => 'MSP',
            'nama_jurusan' => 'Manajemen Sumberdaya Perairan'
        ]);

        Jurusan::create([
            'id_fakultas'=> 3,
            'kode_jurusan' => 'BIG',
            'nama_jurusan' => 'Bahasa dan Sastra Inggris'
        ]);

        Jurusan::create([
            'id_fakultas'=> 3,
            'kode_jurusan' => 'BIN',
            'nama_jurusan' => 'Bahasa dan Sastra Indonesia'
        ]);

        Jurusan::create([
            'id_fakultas'=> 4,
            'kode_jurusan' => 'HKM',
            'nama_jurusan' => 'Ilmu Hukum'
        ]);
    }
}
