<?php

use Caddy\User;
use Caddy\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::disableSearchSyncing();
        Article::disableSearchSyncing();
        $this->call(CategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(TestimoniesTableSeeder::class);
        $this->call(MetasTableSeeder::class);
        $this->call(SocialAccountsTableSeeder::class);
    }
}
