<?php

use Faker\Generator as Faker;

$factory->define(Caddy\Article::class, function (Faker $faker) {
	$title = $faker->sentence;
	return [
		'category_id' => rand(1, 3),
		'title' => $title,
		'slug' => sluggify($title),
		'body' => $faker->paragraphs(3, true),
		'excerpt' => $faker->sentences(3, true),
		'image' => 'articles/' . $faker->image(
			$dir = storage_path() . '/app/public/articles',
			$width = 960,
			$height = 640,
			$category = 'cats',
			$fullPath = false,
			$randomize = true,
		),
	];
});
