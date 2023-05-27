<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\TipeMataPelajaran;
use Faker\Generator as Faker;

$factory->define(TipeMataPelajaran::class, function (Faker $faker) {
    $tipe = '';
    $randN = $faker->numberBetween(1,3);
    switch ($$randN) {
        case 1:
            $tipe = 'Kognitif';
            break;
        case 2:
            $tipe = 'Praktikum';
            break;
        default:
            $tipe = 'Teori';
            break;
    }
    return [
        //
        'tipe_pelajaran' => $tipe
    ];
});
