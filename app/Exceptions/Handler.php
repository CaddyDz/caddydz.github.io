<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Capture errors and report to sentry
	 *
	 * Bind the sentry SDK to the app container
	 *
	 * @param Throwable $exception Exception
	 * @return void
	 **/
	public function report(Throwable $exception): void
	{
		if ($this->shouldReport($exception) && app()->bound('sentry')) {
			app('sentry')->captureException($exception);
		}

		parent::report($exception);
	}
}
