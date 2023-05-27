<?php

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Waktu;
use App\Models\Pengampu;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\TahunAjaran;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $data_tahunajaran = TahunAjaran::all();
        // $data_semester = Semester::all();
        // $data_mapel = MataPelajaran::all();
        // $data_guru = Guru::all();
        $data_kelas = Kelas::all();
        $data_waktu = Waktu::all();
        $data_hari = Hari::all();

        $faker = Faker\Factory::create('id_ID');




        foreach ($data_hari as $hari) {
            foreach ($data_waktu as $waktu) {
                // foreach ($data_kelas as $kelas) {
                $guru = Pengampu::find($faker->numberBetween(63, 93));

                if ($this->checkPenalty()) {
                    Jadwal::updateOrCreate([
                        'tahun_ajaran_id' => 1,
                        'semester_id' => 1,
                        'mapel_id' => $guru->mapel_id,
                        // 'mapel_id' => 8,
                        'id_dosen' => $guru->id_dosen,
                        // 'guru_id' => 1,
                        // 'kelas_id' => $faker->numberBetween(1, 20),
                        'kelas_id' => $faker->numberBetween(2,3), //untuk kelas awal
                        // 'kelas_id' => $kelas->id,
                        'hari_id' => $hari->id,
                        'waktu_id' => $waktu->id,
                        'keterangan' => 'KBM'

                    ]);
                }
                }
            // }
        }
    }

    public function checkPenalty()
    {
        $schedules = Jadwal::select(DB::raw('id_dosen, hari_id, waktu_id, kelas_id, tahun_ajaran_id, semester_id, count(*) as `jumlah`'))
            ->groupBy('id_dosen')
            ->groupBy('hari_id')
            ->groupBy('waktu_id')
            ->groupBy('kelas_id')
            ->groupBy('tahun_ajaran_id')
            ->groupBy('semester_id')
            ->having('jumlah', '>', 1)
            ->get();
        // dd($schedules);

        return $schedules;
    }
}
