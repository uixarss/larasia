<?php

use Illuminate\Database\Seeder;
use App\Models\Waktu;
use App\Models\Hari;

class WaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dataJamMasuk = ['07:00:00', '07:45:00', '08:30:00', '09:15:00', '09:45:00', '10:30:00', '11:15:00', '12:00:00', '12:30:00', '13:15:00', '14:00:00', '14:45:00'];
        $dataJamKeluar = ['07:45:00', '08:30:00', '09:15:00', '09:45:00', '10:30:00', '11:15:00', '12:00:00', '12:30:00', '13:15:00', '14:00:00', '14:45:00', '15:30:00'];



        for ($j = 0; $j < count($dataJamMasuk); $j++) {
            Waktu::create([
                'jam_masuk' => $dataJamMasuk[$j],
                'jam_keluar' => $dataJamKeluar[$j]
            ]);
        }


        for ($i = 0; $i < count($dataHari); $i++) {
            Hari::create([
                'hari' => $dataHari[$i]
            ]);
        }
    }
}
