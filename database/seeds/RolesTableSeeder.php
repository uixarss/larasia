<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'siswa']);
        Role::create(['name' => 'walikelas']);
        Role::create(['name' => 'orangtua']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'pegawai']);
        Role::create(['name' => 'perpustakaan']);
        Role::create(['name' => 'dosen']);
        Role::create(['name' => 'mahasiswa']);
    }
}
