<?php

use Faker\Generator as Faker;

$factory->define(App\Anggota::class, function (Faker $faker) {
    return [
        'nama_anggota' => $faker->name,
        'jenis_kelamin' => $faker->randomElement(['Pria','Wanita']),
        'alamat' => $faker->address,
    ];
});
