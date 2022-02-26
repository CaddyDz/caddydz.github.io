<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;

	/** @var array $details */
	public array $details;

	/**
	 * Create a new message instance.
	 *
	 * @param array $details
	 *
	 * @return void
	 */
	public function __construct(array $details)
	{
		$this->details = $details;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(): ContactMail
	{
		return $this->from([
			'address' => $this->details['email'],
			'name' => $this->details['name'],
		])->markdown('emails.contact')
			->with('details', $this->details);
	}
}
