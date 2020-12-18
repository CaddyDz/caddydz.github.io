<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Book;

class BookObserver
{
	/**
	 * Handle the Book "creating" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function creating(Book $book): void
	{
		$book->slug = sluggify($book->title);
	}

	/**
	 * Handle the Book "created" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function created(Book $book): void
	{
		//
	}

	/**
	 * Handle the Book "updating" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function updating(Book $book): void
	{
		if ($book->isDirty('title')) {
			$book->slug = sluggify($book->title);
		}
	}

	/**
	 * Handle the Book "updated" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function updated(Book $book): void
	{
		//
	}

	/**
	 * Handle the Book "deleted" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function deleted(Book $book): void
	{
		//
	}

	/**
	 * Handle the Book "restored" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function restored(Book $book): void
	{
		//
	}

	/**
	 * Handle the Book "force deleted" event.
	 *
	 * @param \App\Models\Book $book
	 * @return void
	 */
	public function forceDeleted(Book $book): void
	{
		//
	}
}
