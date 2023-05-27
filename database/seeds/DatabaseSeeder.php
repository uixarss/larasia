<?php

use App\Models\AbsensiGuru;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TahunAjaranSeeder::class);
        // $this->call(SemesterSeeder::class);
        // $this->call(FakultasSeeder::class);
        // $this->call(JurusanSeeder::class);
        // $this->call(ProdiSeeder::class);
        // $this->call(KelasSeeder::class);
        $this->call(WaktuSeeder::class);
        // $this->call(MapelSeeder::class);
        // $this->call(MatkulSeeder::class);
        // $this->call(KkmSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(SiswaSeeder::class);
        // $this->call(PegawaiSeeder::class);
        // $this->call(GuruSeeder::class);
        // $this->call(OrtuSeeder::class);
        // $this->call(TambahQuizKelasSeeder::class);
        // $this->call(PembayaranSeeder::class);
        // $this->call(KalenderAkademikSeeder::class);
        // $this->call(EventTableSeeder::class);
        // $this->call(ListRemainderTableSeeder::class);
        // $this->call(AbsensiGuruSeeder::class);
        // $this->call(AbsensiPegawaiSeeder::class);
        // $this->call(AbsensiSiswaSeeder::class);
        // $this->call(TahunAjaranWaliKelas::class);
        // $this->call(NilaiAkhirSeeder::class);

        
        
        $this->call(AlatTransportasiSeeder::class);
        $this->call(JenisPendidikanSeeder::class);
        $this->call(JenisPekerjaanSeeder::class);
        $this->call(JenisPenghasilanSeeder::class);
        $this->call(JenisTinggalSeeder::class);
        $this->call(KebutuhanKhususSeeder::class);
        // $this->call(MahasiswaSeeder::class);
        // $this->call(KelasMahasiswaSeeder::class);
        $this->call(JenjangSeeder::class);
        $this->call(StatusMilikSeeder::class);
        $this->call(PangkatGolonganSeeder::class);
        $this->call(LembagaSeeder::class);
        // $this->call(DosenSeeder::class);
        // $this->call(PengampuSeeder::class);
        // $this->call(SoalSeeder::class);
        // $this->call(JadwalSeeder::class);


    }
}
