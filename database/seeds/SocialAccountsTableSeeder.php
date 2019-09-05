<?php

use Caddy\SocialAccount;
use Illuminate\Database\Seeder;

class SocialAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social_platforms = [
            'Dribbble' => 'fa-dribbble',
            'Facebook' => 'fa-facebook',
            'Twitter' => 'fa-twitter',
            'LinkedIn' => 'fa-linkedin',
            'DeviantArt' => 'fa-deviantart',
            'Behance' => 'fa-behance',
        ];
        foreach ($social_platforms as $name => $icon) {
            SocialAccount::create([
                'platform' => $name,
                'icon' => $icon,
            ]);
        }
    }
}
