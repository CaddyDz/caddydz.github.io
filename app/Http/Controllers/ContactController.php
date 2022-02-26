<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\ContactMail;
use Illuminate\Http\Response;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\{Log, Mail};

class ContactController extends Controller
{
	/**
	 * Send a contact message.
	 *
	 * @param \App\Http\Requests\ContactRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function send(ContactRequest $request): Response
	{
		try {
			Mail::to(config('mail.from.address'))
				->send(
					new ContactMail(
						trimRequest($request->validated())
					)
				);
		} catch (Exception $exception) {
			Log::error($exception->getMessage());
			return response([
				'message' => __('No internet connection detected'),
			], 599);
		}
		return response([
			'message' => __('Your message has been sent!')
		]);
	}
}
