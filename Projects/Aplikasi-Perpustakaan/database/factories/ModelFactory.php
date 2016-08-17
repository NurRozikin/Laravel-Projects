<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

//seeder buku
$factory->define(App\Buku::class, function (Faker\Generator $faker) {
    return [
        'id_buku' => $faker->uuid,
        'judul_buku' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'nama_pengarang' => $faker->name,
        'tahun_terbit' => $faker->year,
		'penerbit' => $faker->sentence($nbWords = 3, $variableNbWords = true),
		'jumlah_buku' => $faker->randomDigit,
		'nomor_rak_buku' => $faker->numerify('buku-###')
    ];
});

//seeder mahasiswa
$factory->define(App\Mahasiswa::class, function (Faker\Generator $faker) {
    return [
        'npm' => $faker->numberBetween($min = 00000000,99999999),
        'nama' => $faker->name,
        'kelas' => $faker->numerify('k-##'),
		'jenis_kelamin' => $faker->randomElement($array = array('pria','wanita')),
		'alamat' => $faker->address
    ];
});

//seeder peminjaman
$factory->define(App\Peminjaman::class, function (Faker\Generator $faker) {
    return [
        'id_peminjaman' => $faker->uuid,
        'tanggal_peminjaman' => $faker->date(),
        'tanggal_batas_pengembalian' => $faker->date(),
        'npm' => factory(App\Mahasiswa::class)->create()->npm,
        'id_buku' => factory(App\Buku::class)->create()->id_buku
    ];
});




