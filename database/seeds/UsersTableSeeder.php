<?php

use Caddy\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Caddy',
            'email' => 'caddy@salimdj.me',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}
