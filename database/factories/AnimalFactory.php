<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Animal;
use Faker\Generator as Faker;

$factory->define(Animal::class, function (Faker $faker) {
    return [
        'name' => $slug = $faker->company,
        'description' => $faker->paragraph,
        'species_id' => function () {
            return App\Species::inRandomOrder()->first();
        },
    ];
});
