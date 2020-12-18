<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Book;
use App\Observers\BookObserver;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Book::observe(BookObserver::class);
	}
}
