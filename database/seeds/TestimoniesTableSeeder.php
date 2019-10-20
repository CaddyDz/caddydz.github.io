<?php

use Caddy\Testimony;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestimoniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Testimony::truncate(); // Delete all previous testimonies (necessary when seeding this table alone)
        // Cleanup old seed files
        Storage::disk('public')->deleteDirectory('testimonies');
        Storage::disk('public')->makeDirectory('testimonies');
        factory(Testimony::class, 3)->create()->each(function ($testimony) use ($faker) {
            $testimony->addMedia($faker->unique()->image('/tmp', 463, 309, 'people'))->toMediaCollection('avatars');
        });
    }
}
