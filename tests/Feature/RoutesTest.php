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
    public function testIndexRoute()
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    /**
     * Test about route.
     *
     * @return void
     */
    public function testAboutRoute()
    {
        $response = $this->get('/about');

        $response->assertOk();
    }

    /**
     * Test about route.
     *
     * @return void
     */
    public function testContactRoute()
    {
        $response = $this->get('/contact');

        $response->assertOk();
    }
}
