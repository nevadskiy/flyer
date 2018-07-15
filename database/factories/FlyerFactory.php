<?php

use Faker\Generator as Faker;

$factory->define(App\Flyer::class, function (Faker $faker) {
    return [
        'street' => $faker->streetAddress,
        'user_id' => factory('App\User')->create()->id,
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'state' => $faker->state,
        'price' => $faker->numberBetween(10000, 5000000),
        'description' => $faker->paragraph(3),
    ];
});
