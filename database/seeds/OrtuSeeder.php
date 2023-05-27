<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Models\DataOrangTua;
use Illuminate\Support\Facades\Hash;
class OrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ortuRole = Role::where('name', 'orangtua')->first();

        $faker = Faker\Factory::create('id_ID');

        for ($i = 0; $i < 20; $i++) {

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);
            $user->roles()->attach($ortuRole);

            $ortu = DataOrangTua::create([
                'user_id' => $user->id,
                'siswa_id' => $faker->unique()->numberBetween(1,20),
                'username' => $faker->unique()->userName,
                'nama_orangtua' => $user->name,
                'email_orangtua' => $user->email,
                'nohp_orangtua' => $faker->phoneNumber,
                'alamat' => $faker->address,
            ]);
        }
    }
}
