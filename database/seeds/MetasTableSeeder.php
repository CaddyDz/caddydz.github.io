<?php

use Caddy\Meta;
use Illuminate\Database\Seeder;

class MetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meta = Meta::create([
            'name' => 'hero',
            'content' =>  'Start your new project with a fresh approach.<br>Salim is truly cutting edge in terms of design and performance;<br> leave your visitors with an experience to remember and <a href="/contact" target="blank">Contact Sales</a> now.',
        ]);
        $meta->setTranslation('content', 'fr', 'Name in English')
             ->setTranslation('content', 'ar', 'Naam in het Nederlands')
             ->save();
    }
}
