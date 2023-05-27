<?php

use Illuminate\Database\Seeder;
use App\Models\Pengampu;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\TahunAjaran;

class PengampuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah_jurusan = count(Jurusan::all());
        $jumlah_prodi = count(Prodi::all());
        $jumlah_matkul = count(MataPelajaran::all());
        $jumlah_semester = count(Semester::all());
        $jumlah_tahun_ajaran = count(TahunAjaran::all());

        $data_fakultas = Fakultas::all();
        $jumlah_fakultas = count($data_fakultas);
        
        
        $faker = Faker\Factory::create('id_ID');

        $dosen = Dosen::all();
        
        foreach ($dosen as $dosen) {
            $id_fakultas = $faker->numberBetween(1,$jumlah_fakultas);

                $data_jurusan = Jurusan::where('id_fakultas', $id_fakultas)->inRandomOrder()->limit(1)->get();
                foreach($data_jurusan as $data_jurusan){
                    $id_jurusan = $data_jurusan->id;
                }
                $data_prodi = Prodi::where('id_prodi', $id_jurusan)->inRandomOrder()->limit(1)->get();
                foreach($data_prodi as $data_prodi){
                    $id_prodi = $data_prodi->id_prodi;
                }
            Pengampu::updateOrCreate([
                'id_dosen' => $dosen->id,
                'id_fakultas' => $id_fakultas,
                'id_jurusan' => $id_jurusan,
                'id_prodi' => $id_prodi,
                'mapel_id' => $faker->numberBetween(1,$jumlah_matkul),
                'id_semester' => $faker->numberBetween(1,$jumlah_semester),
                'id_tahun_ajaran' => $faker->numberBetween(1,$jumlah_tahun_ajaran)

            ]);
        };
    }
}
