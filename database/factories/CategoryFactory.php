<?php

use Caddy\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->sentence(4, true);
    return [
        'name' => $name,
        'user_id' => factory(Caddy\User::class),
        'slug' => sluggify($name),
    ];
});
