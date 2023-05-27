<?php

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_siswa = Siswa::all();

        $faker = Faker\Factory::create('id_ID');

        foreach ($data_siswa as $siswa) {
            for ($i = 1; $i <= 12; $i++) {
                Pembayaran::create([
                    'tahun_ajaran_id' => 1,
                    'semester_id' => 1,
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $siswa->kelas_id,
                    'nama_tagihan' => 'SPP ' . \Carbon\Carbon::parse(now()->addMonths($i))->format('M Y'),
                    'deadline' => now()->addMonths($i),
                    'jumlah_tagihan' => 125000,
                    'status' => 'BELUM LUNAS'
                ]);
            }
        }

        foreach ($data_siswa as $siswa) {
            Pembayaran::create([
                'tahun_ajaran_id' => 1,
                'semester_id' => 1,
                'siswa_id' => $siswa->id,
                'kelas_id' => $siswa->kelas_id,
                'nama_tagihan' => 'SPP ' . \Carbon\Carbon::parse(now()->addMonths(1))->format('M Y'),
                'deadline' => now()->addMonths(1),
                'jumlah_tagihan' => 125000,
                'status' => 'LUNAS'
            ]);
        }
    }
}
