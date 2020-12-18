<?php

declare(strict_types=1);

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Support\Renderable;

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

Route::get('/', function (): Renderable {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
