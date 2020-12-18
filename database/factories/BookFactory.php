<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Book::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'title' => $this->faker->sentence,
			'links' => [
				'pdf' => $this->faker->url,
				'epub' => $this->faker->url,
				'audio' => $this->faker->url,
			]
		];
	}
}
