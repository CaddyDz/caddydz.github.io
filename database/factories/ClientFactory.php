<?php

use Caddy\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
		return [
			'name' => $faker->name,
			'image' => 'clients/' . $faker->image(
				$dir = storage_path() . '/app/public/clients',
				$width = 180,
				$height = 35,
				$category = 'business',
				$fullPath = false,
				$randomize = true,
			),
			'url' => $faker->url,
		];
});
