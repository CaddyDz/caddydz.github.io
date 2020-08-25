<?php

use Caddy\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ClientsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Client::truncate(); // Delete all previous clients (necessary when seeding this table alone)
		// Cleanup old seed files
		Storage::disk('public')->deleteDirectory('clients');
		Storage::disk('public')->makeDirectory('clients');
		factory(Client::class, 6)->create();
	}
}
