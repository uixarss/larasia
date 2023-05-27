<?php

use App\Models\AbsensiDosen;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Hari;
use App\Models\Pengampu;
use App\Models\Prodi;
use Illuminate\Support\Facades\Date;

class AbsensiDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pengampu = Pengampu::find(2);

        $faker = Faker\Factory::create('id_ID');
        for ($i = 1; $i < 15; $i++) {
                AbsensiDosen::create([
                    'id_tahun_ajaran' => 1,
                    'id_semester' => 1,
                    'id_dosen' => $pengampu->id,
                    'id_kelas' => 1,
                    'mapel_id' => $pengampu->mapel_id,
                    'hari_id' => $faker->numberBetween(1, 5),
                    'id_prodi' => $pengampu->id_prodi,
                    'pertemuan_ke' => $i,
                    'waktu_masuk' => now()->addDays($i),
                    'status' => 'Hadir',
                    'keterangan' => null,
                ]);
        }
    }
}
