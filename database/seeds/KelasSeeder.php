<?php

use App\Models\Kelas;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        //
        // factory(App\Kelas::class, 50)->create()->each(function ($kelas) {
        //     // $user->posts()->save(factory(App\Post::class)->make());
        //     $kelas->make();
        // });
        $prodi = Prodi::get();
        $kelas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        foreach ($prodi as $prod) {
            foreach ($kelas as $kelase) {
                Kelas::create([
                    'kode_kelas' => $prod->kode_program_studi . $kelase,
                    'nama_kelas' => $prod->kode_program_studi . '-' . $kelase,
                    'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
                    'jurusan' => $prod->jurusan->nama_jurusan,
                    'jurusan_id' => $prod->jurusan->id,
                    'tingkat' => 1
                ]);
            }
        }
        // Kelas::create([
        //     'kode_kelas' => 'XMIA01',
        //     'nama_kelas' => 'X MIA 01',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XMIA02',
        //     'nama_kelas' => 'X MIA 02',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XMIA03',
        //     'nama_kelas' => 'X MIA 03',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XMIA04',
        //     'nama_kelas' => 'X MIA 04',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XMIA05',
        //     'nama_kelas' => 'X MIA 05',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIPS01',
        //     'nama_kelas' => 'X IPS 01',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIPS02',
        //     'nama_kelas' => 'X IPS 02',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIPS03',
        //     'nama_kelas' => 'X IPS 03',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 10
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIMIPA01',
        //     'nama_kelas' => 'XI IPA 01',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 11
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIMIPA02',
        //     'nama_kelas' => 'XI IPA 02',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 11
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIMIPA03',
        //     'nama_kelas' => 'XI IPA 03',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 11
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIPS01',
        //     'nama_kelas' => 'XI IPS 01',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 11
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIPS02',
        //     'nama_kelas' => 'XI IPS 02',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 11
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIPS03',
        //     'nama_kelas' => 'XI IPS 03',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 11
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIMIPA01',
        //     'nama_kelas' => 'XII IPA 01',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 12
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIMIPA02',
        //     'nama_kelas' => 'XII IPA 02',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 12
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIMIPA03',
        //     'nama_kelas' => 'XII IPA 03',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPA',
        //     'tingkat' => 12
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIIPS01',
        //     'nama_kelas' => 'XII IPA 01',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 12
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIIPS02',
        //     'nama_kelas' => 'XII IPS 02',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 12
        // ]);

        // Kelas::create([
        //     'kode_kelas' => 'XIIIPS03',
        //     'nama_kelas' => 'XII IPS 03',
        //     'kapasitas' => $faker->numberBetween($min = 30, $max = 45),
        //     'jurusan' => 'IPS',
        //     'tingkat' => 12
        // ]);
    }
}
