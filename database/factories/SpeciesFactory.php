<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Species;
use Faker\Generator as Faker;

$factory->define(Species::class, function (Faker $faker) {
    return [
        'name' => $slug = $faker->domainWord,
        'description' => $faker->paragraph,
    ];
});
