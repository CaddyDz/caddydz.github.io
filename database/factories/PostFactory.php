<?php

use Faker\Generator as Faker;

$factory->define(Caddy\Post::class, function (Faker $faker) {
    $title = $faker->sentence();
    return [
        'user_id' => factory(Caddy\User::class),
        'category_id' => factory(Caddy\Category::class),
        'title' => $title,
        'slug' => sluggify($title),
        'body' => $faker->paragraphs(3, true),
        'excerpt' => $faker->sentences(3, true),
        'image' => $faker->imageUrl(960, 640, 'cats'),
    ];
});
