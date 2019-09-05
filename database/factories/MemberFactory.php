<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Caddy\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'position' => $faker->jobTitle,
        'description' => $faker->realText(),
        'photo' => 'members/' . $faker->image(
            $dir = storage_path() . '/app/public/members',
            $width = 800,
            $height = 614,
            $category = 'people',
            $fullPath = false,
            $randomize = true,
        ),
    ];
});
