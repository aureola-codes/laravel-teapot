<?php

namespace Aureola\LaravelTeapot\Tests\Unit;

use Aureola\LaravelTeapot\Tests\TestCase;
use Illuminate\Http\Request;

class IsTeapotPathTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('teapot.ignore_logged_in', false);
    }

    public function test_returns_true_when_path_matches_literal(): void
    {
        config()->set('teapot.paths', ['\.env', 'wp-admin']);

        $this->assertTrue(is_teapot_request(Request::create('/.env')));
        $this->assertTrue(is_teapot_request(Request::create('/.env.backup')));
        $this->assertTrue(is_teapot_request(Request::create('/wp-admin')));
        $this->assertTrue(is_teapot_request(Request::create('/wp-admin/foo')));
    }

    public function test_returns_false_when_path_does_not_match(): void
    {
        config()->set('teapot.paths', ['\.env', 'wp-admin']);

        $this->assertFalse(is_teapot_request(Request::create('/login')));
        $this->assertFalse(is_teapot_request(Request::create('/api/users')));
    }

    public function test_matching_is_case_insensitive(): void
    {
        config()->set('teapot.paths', ['wp-admin']);

        $this->assertTrue(is_teapot_request(Request::create('/WP-ADMIN')));
        $this->assertTrue(is_teapot_request(Request::create('/Wp-Admin')));
    }

    public function test_returns_false_when_ignore_logged_in_and_user_authenticated(): void
    {
        config()->set('teapot.paths', ['\.env']);
        config()->set('teapot.ignore_logged_in', true);

        $request = Request::create('/.env');
        $request->setUserResolver(fn () => (object) ['id' => 1]);

        $this->assertFalse(is_teapot_request($request));
    }

    public function test_returns_true_when_ignore_logged_in_but_user_guest(): void
    {
        config()->set('teapot.paths', ['\.env']);
        config()->set('teapot.ignore_logged_in', true);

        $request = Request::create('/.env');
        $request->setUserResolver(fn () => null);

        $this->assertTrue(is_teapot_request($request));
    }

    public function test_empty_paths_matches_nothing(): void
    {
        config()->set('teapot.paths', []);

        $this->assertFalse(is_teapot_request(Request::create('/.env')));
    }
}
