<?php

use Caddy\Testimony;
use Faker\Generator as Faker;

$factory->define(Testimony::class, function (Faker $faker) {
	return [
		'quote' => $faker->realText(),
		'endorser' => "$faker->jobTitle - $faker->company",
	];
});
