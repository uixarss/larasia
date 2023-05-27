<?php

use Illuminate\Database\Seeder;
use App\Models\ProfilPT;
use Illuminate\Support\Facades\Hash;

class ProfilPTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //

         $faker = Faker\Factory::create('id_ID');
 
         $data_profil = ProfilPT::create([
                'id_perguruan_tinggi' => '4gf4fcd5-69e0-4eca-b381-db314acdfdsw',
                'kode_perguruan_tinggi' => '344067',
                'nama_perguruan_tinggi' => 'Unversitas Kedawung',
                'telepon' => '0231-123456789',
                'faximile' => '0231-123456789',
                'email' => 'kampus@kampus.ac.id',
                'jalan'=> 'Jalan Kamboja',
                'website' => 'kampus.ac.id',
                'dusun' => '',
                'rt_rw'=> '',
                'kelurahan' => '',
                'kode_pos'=> '45456',
                'id_wilayah' => '24',
                'nama_wilayah' => 'Cirebon',
                'lintang_bujur'=> null,
                'bank' => null,
                'unit_cabang' => null,
                'nomor_rekening' => null,
                'mbs' => '0',
                'luas_tanah_milik' => '0',
                'luas_tanah_bukan_milik' => '0',
                'sk_pendirian' => null,
                'tanggal_sk_pendirian' => null,
                'id_status_milik' => 1,
                'nama_status_milik' => 'Pemerintah Pusat',
                'status_perguruan_tinggi' => 'A',
                'sk_izin_operasional' => null,
                'tanggal_izin_operasional' => null
                 ]);
             
         
 
    }
}
