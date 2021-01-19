<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

/*
* Configure download center subdomain, to be caught by nginx wildcard
* All routes in this group should point to a storage directory
* Then a file to be downloaded
* the server response should instruct the browser to directly download that file
*/

Route::domain('downloads.' . config('app.domain'))->group(function () {
	Route::prefix('books')->group(function () {
		Route::get('{book}', [BooksController::class, 'download']);
	});
});

Route::view('/', 'index');

Route::get('cv', fn () => response()->download(public_path('cv.pdf'), 'CV Salim Djerbouh.pdf'))->name('cv');
