<?php

use Illuminate\Database\Seeder;
use App\JenisPekerjaan;

class JenisPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Tidak Bekerja',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'PNS',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'TNI/Polri',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Swasta',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Petani',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Nelayan',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Buruh',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Pensiunan',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Serabutan',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Wirausaha',
        ]);

        JenisPekerjaan::create([
            'jenis_pekerjaan' => 'Lainnya',
        ]);
        
    }
}
