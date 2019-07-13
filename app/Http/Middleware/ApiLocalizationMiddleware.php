<?php

namespace Caddy\Http\Middleware;

use Closure;

class ApiLocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check header request and determine localizaton
        $header_locale = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';
        if (in_array($header_locale, config('app.locales'))) {
            // Keep the locale if already in session
            $locale = $header_locale;
        } else {
            // Fallback to English if not defined
            $locale = config('app.locale');
        }
        // set laravel localization
        app()->setLocale($locale);
        // continue request
        return $next($request);
    }
}
