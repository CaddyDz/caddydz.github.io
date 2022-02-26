<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'name' => 'bail|required|string|min:3|max:50',
			'email' => 'bail|required|email',
			'message' => 'bail|required|string|min:10|max:5000',
		];
	}
}
