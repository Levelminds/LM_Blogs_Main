<?php
namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_homepage_returns_ok(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
