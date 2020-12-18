<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		User::factory()->create([
			'name' => 'Admin',
			'email' => 'admin@caddy.dev',
		]);
	}
}
