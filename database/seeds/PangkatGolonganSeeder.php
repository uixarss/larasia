<?php

use Illuminate\Database\Seeder;
use App\PangkatGolongan;

class PangkatGolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PangkatGolongan::create([
            'jabatan' => 'Asisten Ahli',
            'pangkat'=> 'Penata Muda',
            'golongan' => 'III/a',
            'angka_kredit' => '100'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Asisten Ahli',
            'pangkat'=> 'Penata Muda Tk.I',
            'golongan' => 'III/b',
            'angka_kredit' => '150'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Lektor',
            'pangkat'=> 'Penata',
            'golongan' => 'III/c',
            'angka_kredit' => '200'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Lektor',
            'pangkat'=> 'Penata Tk.I',
            'golongan' => 'III/d',
            'angka_kredit' => '300'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Lektor Kepala',
            'pangkat'=> 'Pembina',
            'golongan' => 'IV/a',
            'angka_kredit' => '400'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Lektor Kepala',
            'pangkat'=> 'Pembina Tk.I',
            'golongan' => 'IV/b',
            'angka_kredit' => '550'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Lektor Kepala',
            'pangkat'=> 'Pembina Utama Muda',
            'golongan' => 'IV/c',
            'angka_kredit' => '700'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Guru Besar atau Profesor',
            'pangkat'=> 'Pembina Utama Madya',
            'golongan' => 'IV/d',
            'angka_kredit' => '850'
        ]);

        PangkatGolongan::create([
            'jabatan' => 'Guru Besar atau Profesor',
            'pangkat'=> 'Pembina Utama',
            'golongan' => 'IV/e',
            'angka_kredit' => '1050'
        ]);

    }
}
