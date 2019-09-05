<?php

namespace Caddy\Providers;

use Caddy\Client;
use Caddy\Project;
use Caddy\Testimony;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['partials.testimonies', 'layouts.footer'], function ($view) {
            return $view->with('testimonies', Testimony::latest()->take(10)->get());
        });
        view()->composer('partials.clients', function ($view) {
            return $view->with('clients', Client::latest()->take(6)->get());
        });
        view()->composer('partials.portfolio', function ($view) {
            return $view->with('projects', Project::latest()->take(6)->get());
        });
    }
}
