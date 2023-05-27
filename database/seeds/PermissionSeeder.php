<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $actions = [
            'view', 'manage', 'create', 'update', 'edit', 'delete'
        ];
        $objects = [
            'users', 'kurikulum', 'kelas', 'fakultas', 'jurusan','prodi', 'jenjang', 'profil-pt', 'kuis',
            'chat', 'mata-kuliah', 'materi-pelajaran', 'jadwal-kelas', 'mahasiswa', 'dosen', 'pegawai', 'tugas', 'soal',
            'jadwal-ujian','nilai', 'keuangan', 'absensi-dosen', 'absensi-mahasiswa', 'agenda', 'chat', 'perpustakaan'
        ];
        foreach ($objects as $object) {
            foreach ($actions as  $action) {
                Permission::updateOrCreate([
                    'name' => $action . '-' . $object
                ]);
            }
        }
    }
}
