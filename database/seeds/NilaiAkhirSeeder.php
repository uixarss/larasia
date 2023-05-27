<?php

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\NilaiHarian;
use App\Models\NilaiAkhir;

class NilaiAkhirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create('id_ID');

      // $data_kelas = Kelas::find($faker->numberBetween(1, 5));

      $data_siswa = Siswa::all();

      $tahun_ajaran = TahunAjaran::
          // where('status', true)
          where('start_date', '>', now())
          ->orWhere('end_date', '<', now())
          ->first();

      $semester = Semester::where('id', $tahun_ajaran->id)->first();




      foreach ($data_siswa as $siswa) {

        $data_guru = Guru::all();
        // $guru = Guru::find($faker->numberBetween(1, 9));
        foreach ($data_guru as $guru) {

          $nilai_harian = NilaiHarian::create([
              'siswa_id' => $siswa->id,
              'guru_id'  => $faker->numberBetween(1,20),
              'mapel_id' => $guru->mapel_id,
              'tahun_ajaran_id' => $tahun_ajaran->id,
              'semester_id' => $semester->id,
              'nilai_harian' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100)
            ]);

            $nilai_akhir = NilaiAkhir::create([
                'siswa_id' => $siswa->id,
                'guru_id'  => $faker->numberBetween(1,20),
                'mapel_id' => $guru->mapel_id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'semester_id' => $semester->id,
                'nilai_akhir' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100)
              ]);

          // $nilai_harian = NilaiHarian::create([
          //     'siswa_id' => $siswa->id,
          //     'guru_id'  => 1,
          //     'mapel_id' => 5,
          //     'tahun_ajaran_id' => $tahun_ajaran->id,
          //     'semester_id' => $semester->id,
          //     'nilai_harian' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100)
          //   ]);
          //
          //   $nilai_akhir = NilaiAkhir::create([
          //       'siswa_id' => $siswa->id,
          //       'guru_id'  => 1,
          //       'mapel_id' => 5,
          //       'tahun_ajaran_id' => $tahun_ajaran->id,
          //       'semester_id' => $semester->id,
          //       'nilai_akhir' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100)
          //     ]);
          //
          //     $nilai_harian = NilaiHarian::create([
          //         'siswa_id' => $siswa->id,
          //         'guru_id'  => 3,
          //         'mapel_id' => 3,
          //         'tahun_ajaran_id' => $tahun_ajaran->id,
          //         'semester_id' => $semester->id,
          //         'nilai_harian' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100)
          //       ]);
          //
          //       $nilai_akhir = NilaiAkhir::create([
          //           'siswa_id' => $siswa->id,
          //           'guru_id'  => 3,
          //           'mapel_id' => 3,
          //           'tahun_ajaran_id' => $tahun_ajaran->id,
          //           'semester_id' => $semester->id,
          //           'nilai_akhir' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100)
          //         ]);
          //
          //
          //         $nilai_harian = NilaiHarian::create([
          //             'siswa_id' => $siswa->id,
          //             'guru_id'  => 1,
          //             'mapel_id' => 1,
          //             'tahun_ajaran_id' => $tahun_ajaran->id,
          //             'semester_id' => $semester->id,
          //             'nilai_harian' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100)
          //           ]);
          //
          //           $nilai_akhir = NilaiAkhir::create([
          //               'siswa_id' => $siswa->id,
          //               'guru_id'  => 1,
          //               'mapel_id' => 1,
          //               'tahun_ajaran_id' => $tahun_ajaran->id,
          //               'semester_id' => $semester->id,
          //               'nilai_akhir' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 100)
          //             ]);

          }

        }

    }
}
