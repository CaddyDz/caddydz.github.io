<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
	/**
	 * Download the specified book.
	 *
	 * @param \App\Models\Book $book
	 * @return \Illuminate\Http\Response
	 */
	public function download(Book $book)
	{
		$format = request()->query('format', 'pdf');
		$validator = Validator::make(request()->all(), [
			'format' => 'nullable|in:pdf,epub,audio',
		]);

		if ($validator->fails()) {
			return redirect('https://http.cat/400');
		}
		// Get the book media file where the format is the given format
		$file = $book->getMedia('files')->where('extension', $format)->first();
		// if file format is unavailable, redirect
		return $file ? $file : redirect('https://http.cat/303');
	}
}
