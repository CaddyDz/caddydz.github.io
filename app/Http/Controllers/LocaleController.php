<?php

namespace Caddy\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function update($locale)
    {
        // Check if the $locale passed is in the array config/app.php => locales
        if (in_array($locale, config('app.locales'))) {
            // Put the $locale in session with the same name as key
            session(['locale' => $locale]);
        }
        // redirect back
        return back();
    }
}
