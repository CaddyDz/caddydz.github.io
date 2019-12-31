<?php

use Caddy\User;
use Caddy\Article;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Cleanup old seed files
        Storage::disk('public')->deleteDirectory('avatars');
        Storage::disk('public')->makeDirectory('avatars');
        Storage::disk('public')->deleteDirectory('articles');
        Storage::disk('public')->makeDirectory('articles');
        // Create caddy as an admin user
        User::create([
            'name' => 'Caddy',
            'email' => 'caddy@salimdj.me',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
        // Create 5 users and each user has 3 articles
        factory(User::class, 5)->create()->each(function ($user) use ($faker) {
            $user->addMedia($faker->unique()->image('/tmp', 800, 534, 'people'))->toMediaCollection('avatars');
            $user->articles()->createMany(factory(Article::class, 3)->make()->toArray());
        });
    }
}
