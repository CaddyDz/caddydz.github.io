<?php

namespace Caddy\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Model::unguard();
		URL::forceScheme('https');
	}
}
