<?php

use Illuminate\Database\Seeder;
use App\Models\TipeMataPelajaran;
use App\Models\MataPelajaran;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //
        $tipeMapel1 = TipeMataPelajaran::create([
            'tipe_pelajaran' => 'Praktikum'
        ]);
        $tipeMapel2 = TipeMataPelajaran::create([
            'tipe_pelajaran' => 'Kognitif'
        ]);

        $dataMataPelajaran = ['Matematika', 'Bahasa Inggris', 'Bahasa Indonesia',
                            'Penjasorkes', 'Seni Budaya','TIKOM',
                            'PKN', 'Agama', 'Sejarah',
                            'Bahasa Daerah', 'Bahasa Asing', 'Prakarya dan Kewirausahaan',
                            'Fisika', 'Kimia', 'Biologi',
                            'Ekonomi', 'Geografi','Sosiologi',
                            'Peminatan Akademik'
                        ];

        for ($i=0; $i < count($dataMataPelajaran); $i++) {

            $mapel = MataPelajaran::create([
                'nama_mapel' => $dataMataPelajaran[$i],
                'type' => 'Teori',
                'jumlah_jam' => $faker->numberBetween(2,3)
            ]);
        }
        // for ($i=0; $i < count($dataMataPelajaran); $i++) {

        //     $mapel = MataPelajaran::create([
        //         'nama_mapel' => $dataMataPelajaran[$i],
        //         'tipe_mapel_id' => 2,
        //         'jumlah_jam' => $faker->numberBetween(1,3)
        //     ]);
        // }


    }
}
