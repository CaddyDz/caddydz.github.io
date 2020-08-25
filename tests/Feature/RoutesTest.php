<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutesTest extends TestCase
{
	/**
	 * Test index route.
	 *
	 * @return void
	 */
	public function test_index_route()
	{
		$response = $this->get('/');

		$response->assertOk();
	}

	/**
	 * Test about route.
	 *
	 * @return void
	 */
	public function test_about_route()
	{
		$response = $this->get('/about');

		$response->assertOk();
	}

	/**
	 * Test about route.
	 *
	 * @return void
	 */
	public function test_contact_route()
	{
		$response = $this->get('/contact');

		$response->assertOk();
	}
}
