<?php

use Caddy\Member;
use Caddy\SocialAccount;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(Faker $faker)
	{
		Storage::disk('public')->deleteDirectory('members');
		Storage::disk('public')->makeDirectory('members');
		$accounts = SocialAccount::all('id');
		factory(Member::class, 3)->create()->each(function($member) use ($accounts, $faker) {
			$member->addMedia($member->photo)->toMediaCollection('avatars');
			foreach ($accounts as $account) {
				$member->socialAccounts()->attach($account, ['url' => $faker->url]);
			}
		});
	}
}
