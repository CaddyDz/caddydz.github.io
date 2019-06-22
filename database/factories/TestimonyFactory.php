<?php

use Caddy\Testimony;
use Faker\Generator as Faker;

$factory->define(Testimony::class, function (Faker $faker) {
    return [
        'quote' => $faker->realText(),
        'avatar' => 'testimonies/' . $faker->image(storage_path() . '/app/public/testimonies', 151, 101, 'people', false, false),
        'endorser' => "$faker->jobTitle - $faker->company",
    ];
});
