<?php

use Illuminate\Database\Seeder;
use App\StatusMilik;
use Illuminate\Support\Facades\Hash;

class StatusMilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_milik = StatusMilik::create([
            'status_milik' => 'Pemerintah Pusat'
          ]);
          
        $status_milik2 = StatusMilik::create([
            'status_milik' => 'Swasta'
          ]);

        $status_milik3 = StatusMilik::create([
            'status_milik' => 'Luar Negeri'
        ]);
    }
}