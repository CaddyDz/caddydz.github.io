<?php

use Caddy\Testimony;
use Faker\Generator as Faker;

$factory->define(Testimony::class, function (Faker $faker) {
    return [
        'quote' => $faker->realText(),
        'photo' => 'testimonies/' . $faker->image(
            $dir = storage_path() . '/app/public/testimonies',
            $width = 463,
            $height = 309,
            $category = 'people',
            $fullPath = false,
            $randomize = true,
        ),
        'endorser' => "$faker->jobTitle - $faker->company",
    ];
});
