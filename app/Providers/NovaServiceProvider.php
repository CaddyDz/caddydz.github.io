<?php

declare(strict_types=1);

namespace App\Providers;

use Throwable;
use Illuminate\Foundation\Inspiring;
use Laravel\Nova\{Nova, NovaApplicationServiceProvider};

class NovaServiceProvider extends NovaApplicationServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		parent::boot();

		Nova::initialPath('/resources/books');

		// Randomly show new quotes in the footer
		Nova::footer(
			fn () => view('vendor.nova.footer', [
				'quote' => Inspiring::quote(),
			])->render()
		);
	}

	/**
	 * Register the Nova routes.
	 *
	 * @return void
	 */
	protected function routes(): void
	{
		Nova::routes()
			->withAuthenticationRoutes()
			->withPasswordResetRoutes()
			->register();
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		Nova::report(function (Throwable $exception) {
			if (app()->bound('sentry')) {
				app('sentry')->captureException($exception);
			}
		});
	}
}
