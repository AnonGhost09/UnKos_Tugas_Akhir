<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kamar;
use Faker\Generator as Faker;

$factory->define(Kamar::class, function (Faker $faker) {
    return [
        'penyewa'=>$faker->name,
        'max'=>3,
        'id_kos'=>2,
    ];
});
