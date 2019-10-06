<?php

use Caddy\Testimony;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestimoniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('testimonies');
        Storage::disk('public')->makeDirectory('testimonies');
        factory(Testimony::class, 3)->create()->each(function($testimony) {
            $testimony->addMedia($testimony->photo)->toMediaCollection('avatars');
        });
    }
}
