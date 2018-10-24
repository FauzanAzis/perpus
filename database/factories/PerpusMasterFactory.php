<?php

use Faker\Generator as Faker;


$factory->define(\App\Klasifikasi::class, function (Faker $faker) {
    return [
        'nama_klasifikasi' => $faker->word,
    ];
});

$factory->define(\App\Pengarang::class, function (Faker $faker) {
    return [
        'nama_pengarang' => $faker->name,
        'telepon' => $faker->phoneNumber,
    ];
});

$factory->define(\App\Penerbit::class, function (Faker $faker) {
    return [
        'nama_penerbit' => $faker->randomElement(['Erlangga','Yudhistira', 'Aditya Media','AK Group', 'Andi Offset']),
        'alamat_penerbit' => $faker->address,
    ];
});

$factory->define(\App\Buku::class, function (Faker $faker) {
    return [
        'judul' => $faker->paragraph,
        'pengarang_id' => function() {
            return factory(\App\Pengarang::class)->create()->id;
        },
        'penerbit_id' => function() {
            return factory(\App\Penerbit::class)->create()->id;
        },
        'klasifikasi_id' => function() {
            return factory(\App\Klasifikasi::class)->create()->id;
        },
        'bahasa' => $faker->randomElement(['Indonesia', 'Inggris']),
        'edisi' => $faker->randomElement(['I', 'II', 'III', 'IV', 'V']),
        'isbn' => $faker->isbn10,
        'stok' => $faker->numberBetween(0,100)
    ];
});
