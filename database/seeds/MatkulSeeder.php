<?php

use Illuminate\Database\Seeder;
use App\Models\TipeMataPelajaran;
use App\Models\MataPelajaran;

class MatkulSeeder extends Seeder
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

        $dataMataPelajaran = ['MATEMATIKA TEKNIK', 'BAHASA INGGRIS', 'BAHASA INDONESIA',
                              'PENDIDIKAN PANCASILA DAN KEWARGANEGARAAN', 'PENDIDIKAN AGAMA', 'KALKULUS I', 'EKONOMI TEKNIK',
                              'TECHNOPRENEURSHIP', 'PEMROGRAMAN I', 'ALJABAR LINIER DAN VARIABEL KOMPLEKS', 'FISIKA DASAR'
                        ];
        $dataMapel = ['MTT01', 'ENG01', 'IND01',
                              'PKN01', 'AGM01', 'KKL01', 'EKT01',
                              'TPS01', 'PMG01', 'ALV01', 'FSD01'
                        ];

        for ($i=0; $i < count($dataMataPelajaran); $i++) {

            $mapel = MataPelajaran::create([
                'kode_mapel' => $dataMapel[$i],
                'nama_mapel' => $dataMataPelajaran[$i],
                'type' => 'Teori',
                'jumlah_sks' => $faker->numberBetween(2,4),
                'jumlah_jam' => $faker->numberBetween(2,3)
            ]);
        }

    }
}
