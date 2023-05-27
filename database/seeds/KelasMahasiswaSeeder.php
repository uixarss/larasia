<?php

use Illuminate\Database\Seeder;
use App\Models\KelasMahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Fakultas;

class KelasMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('id_ID');

        $data_kelas = Kelas::all();
        $jumlah_kelas = count($data_kelas);

        $data_fakultas = Fakultas::all();
        $jumlah_fakultas = count($data_fakultas);
        
        
        $data_semester = Semester::all();
        $jumlah_semeter = count($data_semester);
        $data_tahun_ajaran = TahunAjaran::all();
        $jumlah_tahun = count($data_tahun_ajaran);


        $mahasiswa = Mahasiswa::all();

            foreach ($mahasiswa as $mahasiswa) {
                
                $id_fakultas = $faker->numberBetween(1,$jumlah_fakultas);

                $data_jurusan = Jurusan::where('id_fakultas', $id_fakultas)->inRandomOrder()->limit(1)->get();
                foreach($data_jurusan as $data_jurusan){
                    $id_jurusan = $data_jurusan->id;
                }
                $data_prodi = Prodi::where('id_prodi', $id_jurusan)->inRandomOrder()->limit(1)->get();
                foreach($data_prodi as $data_prodi){
                    $id_prodi = $data_prodi->id_prodi;
                }
                if ($this->checkPenalty()) {
                    KelasMahasiswa::updateOrCreate([
                        'user_id' => $mahasiswa->user_id,
                        'id_kelas' => $faker->numberBetween(1,$jumlah_kelas),
                        'id_fakultas' => $id_fakultas,
                        'id_jurusan' => $id_jurusan,
                        'id_prodi' => $id_prodi,
                        'id_semester' => $faker->numberBetween(1,$jumlah_semeter),
                        'id_tahun_ajaran' => $faker->numberBetween(1,$jumlah_tahun)

                    ]);
                }
            }
    }

    public function checkPenalty()
    {
        $jumlah = KelasMahasiswa::select(DB::raw('user_id, id_kelas, id_fakultas, id_jurusan, id_prodi, id_semester, id_tahun_ajaran, count(*) as `jumlah`'))
            ->groupBy('user_id')
            ->having('jumlah', '>', 1)
            ->get();
        // dd($schedules);

        return $jumlah;
    }
}
