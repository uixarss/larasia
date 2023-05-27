<?php

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            'id_jurusan' => 1,
            'kode_program_studi' => 'D3TM',
            'nama_program_studi'=> 'D3 - Teknik Mesin',
            'status'=> 'A',
            'id_jenjang_pendidikan' => 3,
            'nama_jenjang_pendidikan' => 'D3',
        ]);

        Prodi::create([
            'id_jurusan' => 2,
            'kode_program_studi' => 'D3TKIM',
            'nama_program_studi'=> 'D3 - Teknik Kimia',
            'status'=> 'B',
            'id_jenjang_pendidikan' => 3,
            'nama_jenjang_pendidikan' => 'D3',
        ]);


        Prodi::create([
            'id_jurusan' => 3,
            'kode_program_studi' => 'S1MSP',
            'nama_program_studi' => 'S1 - Manajemen Sumber Daya Perikanan',
            'status' => 'A',
            'id_jenjang_pendidikan'=> '4',
            'nama_jenjang_pendidikan' => 'S1'
        ]);

        Prodi::create([
            'id_jurusan' => 5,
            'kode_program_studi' => 'D3BIN',
            'nama_program_studi' => 'D3 - Bahasa Indonesia',
            'status' => 'B',
            'id_jenjang_pendidikan'=> '3',
            'nama_jenjang_pendidikan' => 'D3'
        ]);
        
        Prodi::create([
            'id_jurusan' => 4,
            'kode_program_studi' => 'D3BIG',
            'nama_program_studi' => 'D3 - Bahasa Inggris',
            'status' => 'B',
            'id_jenjang_pendidikan'=> '3',
            'nama_jenjang_pendidikan' => 'D3'
        ]);

        Prodi::create([
            'id_jurusan' => 6,
            'kode_program_studi' => 'S1HKM',
            'nama_program_studi' => 'S1 - Ilmu Hukum',
            'status' => 'A',
            'id_jenjang_pendidikan'=> '4',
            'nama_jenjang_pendidikan' => 'S1'
        ]);

    }
}
