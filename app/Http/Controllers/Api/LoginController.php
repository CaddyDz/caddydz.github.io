<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TokenRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
	/**
	 * details api
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \App\Models\User $user
	 */
	public function user(Request $request): User
	{
		return $request->user();
	}

	/**
	 * login api
	 *
	 * @param \App\Http\Requests\TokenRequest $request
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 *
	 * @return string user personal API token
	 */
	public function login(TokenRequest $request): string
	{
		$user = User::where('email', $request->email)->first();

		if (! $user || ! Hash::check($request->password, $user->password)) {
			throw ValidationException::withMessages([
				'email' => ['The provided credentials are incorrect.'],
			]);
		}

		return $user->createToken('SPA')->plainTextToken;
	}

	/**
	 * Logout user
	 *
	 * Revoke all tokens of user
	 *
	 * @param \Illuminate\Http\Request $request Request object
	 * @return \Illuminate\Http\Response
	 **/
	public function logout(Request $request): Response
	{
		// Revoke all tokens...
		$request->user()->tokens()->delete();
		return response([
			'status' => 'Logged out',
		], 204);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
	 */
	public function register(Request $request): string
	{
		$user = new User([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password)
		]);
		$user->save();
		return $user->createToken('SPA')->plainTextToken;
	}
}
