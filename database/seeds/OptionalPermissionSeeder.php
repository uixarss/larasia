<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class OptionalPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $action = [
            'view', 'manage', 'create','update','edit','delete'
        ];
        $list_permission = [
            'paket-krs',
            'paket-semester-pendek',
            'daftar-ulang',
            'krs',
            'sp',
            'khs',
            'jadwal-sp',
            'jadwal-pengganti'
        ];

        foreach ($action as $act ) {
            foreach($list_permission as $permission) {
                Permission::create([
                    'name' => $act.'-'. $permission
                ]);
            }
        }
    }
}
