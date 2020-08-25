<?php

namespace Caddy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendContactEmailRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'fullname' => 'bail|required|string|min:3|max:50',
			'subject' => 'nullable|string|min:3|max:50',
			'phone' => 'nullable|integer|min:8|max:30',
			'email' => 'bail|required|email|min:7|max:50',
			'message' => 'bail|required|string|min:10|max:99999',
		];
	}
}
