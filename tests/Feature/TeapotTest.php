<?php

namespace Aureola\LaravelTeapot\Tests\Feature;

use Aureola\LaravelTeapot\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class TeapotTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('teapot.paths', ['\.env', 'wp-admin']);
    }

    public function test_fallback_returns_418_for_teapot_path(): void
    {
        $response = $this->get('/.env');

        $response->assertStatus(Response::HTTP_I_AM_A_TEAPOT);
    }

    public function test_fallback_returns_418_for_teapot_path_prefix(): void
    {
        $response = $this->get('/.env.backup');

        $response->assertStatus(Response::HTTP_I_AM_A_TEAPOT);
    }

    public function test_fallback_returns_404_for_non_teapot_path(): void
    {
        $response = $this->get('/some-random-path');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
