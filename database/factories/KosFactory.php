<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kos;
use Faker\Generator as Faker;

$factory->define(Kos::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'title' => $faker->text,
        'latitude' => $faker->latitude(),
        'longtitude' => $faker->longitude(),
        'id_pemilik' => 1
    ];
});
