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
        Storage::disk('public')->deleteDirectory('clients');
        Storage::disk('public')->makeDirectory('clients');
        factory(Client::class, 6)->create();
    }
}
