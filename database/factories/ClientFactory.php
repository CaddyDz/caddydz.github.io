<?php

use Caddy\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'image' => 'clients/' . $faker->image(storage_path() . '/app/public/clients', 180, 35, 'business', false, true),
		'url' => $faker->url,
	];
});
