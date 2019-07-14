<?php

namespace Caddy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('partials.pagination');
        Paginator::defaultSimpleView('partials.pagination');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
