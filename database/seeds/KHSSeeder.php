<?php

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\KartuHasilStudi;
use App\Models\KartuHasilStudiDetail;

class KHSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker\Factory::create('id_ID');

        $mutu = ['A','B', 'C', 'D', 'E'];

        $mahasiswa = Mahasiswa::all();
        
        foreach ($mahasiswa as $mahasiswa) {
            
            $khs = KartuHasilStudi::create([

                'id_mahasiswa' => $mahasiswa->id,
                'tingkat_semester' => $faker->numberBetween(1,8),
                'id_prodi' => $mahasiswa->id_prodi,
                'id_semester' => $faker->numberBetween(1,2),
                'id_tahun_ajaran' => $faker->numberBetween(1,2)
                
            ]);

            for( $i = 0; $i <= 6;  $i++){

                $khs_detail = KartuHasilStudiDetail::create([
                    'kartu_hasil_studi_id' => $khs->id,
                    'mapel_id' => $faker->numberBetween(1,8),
                    'mutu' => $mutu[$faker->numberBetween(0,4)],
                    'nilai' => $faker->numberBetween(0,100),
                    'id_dosen' => $faker->numberBetween(1,30),
                    'disetujui_oleh' => "Admin",
                    'diubah_oleh' => "Admin",
                    'keterangan' => ""
                ]);

            }

        }

    }
}
