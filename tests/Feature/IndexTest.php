<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
	/**
	 * Assert success HTTP status code on index page.
	 *
	 * @return void
	 */
	public function test_index_page(): void
	{
		$response = $this->get('/');

		$response->assertOk();
	}
}
