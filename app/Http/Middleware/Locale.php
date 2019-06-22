<?php

namespace Caddy\Http\Middleware;

use Closure;

class Locale
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
        $session_locale = session('locale');
        if (in_array($session_locale, config('app.locales'))) {
            // Keep the locale if already in session
            $locale = $session_locale;
        } else {
            // Fallback to English if not defined
            $locale = config('app.locale');
        }
        app()->setLocale($locale);
        return $next($request);
    }
}
