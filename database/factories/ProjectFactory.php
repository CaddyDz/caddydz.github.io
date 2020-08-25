<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Caddy\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
	$title = $faker->sentence($nbWords = 5, $variableNbWords = false);
	$name = $faker->word;
	return [
		'name' => $name,
		'title' => $title,
		'excerpt' => $faker->paragraph,
		'description' => $faker->realText(),
		'screenshot' => 'projects/' . $faker->image(
			$dir = storage_path() . '/app/public/projects',
			$width = 1545,
			$height = 869,
			$category = 'technics',
			$fullPath = false,
			$randomize = true,
		),
		'slug' => sluggify($name . '-' . $title),
	];
});
