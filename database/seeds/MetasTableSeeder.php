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
		$metas = [
			[
				'name' => 'heroTitle',
				'content' => [
					'en' => '<h2>Salim Djerbouh</h2><h3>A Modern Web Developer</h3>',
					'fr' => '<h2>Salim Djerbouh</h2><h3>Un développeur Web moderne</h3>',
					'ar' => '<h2>سليم جربوح</h2><h3>مطور ويب حديث</h3>',
				]
			],
			[
				'name' => 'heroContent',
				'content' => [
					'en' => 'Start your new project with a fresh approach.<br>Salim is truly cutting edge in terms of design and performance;<br> leave your visitors with an experience to remember and <a href="/contact" target="blank">Contact Sales</a> now.',
					'fr' => 'Commencez votre nouveau projet avec une nouvelle approche.<br>Salim est vraiment à la pointe en termes de conception et de performance;<br> laissez à vos visiteurs une expérience inoubliable et <a href="/contact" target="blank">Contact commercial</a> maintenant.',
					'ar' => 'ابدأ مشروعك الجديد بنهج جديد.<br>سليم هو حقا المتطور من حيث التصميم والأداء.<br> أترك زوارك بتجربة لا تنسى و  <a href="/contact" target="blank">إتصل بالمبيعات</a> الآن.',
				]
			],
		];
		Meta::truncate();
		foreach ($metas as $meta) {
			Meta::create([
				'name' => $meta['name'],
				'content' => $meta['content']['en'],
			])->setTranslation('content', 'fr', $meta['content']['fr'])
				->setTranslation('content', 'ar', $meta['content']['ar'])
				->save();
		}
	}
}
