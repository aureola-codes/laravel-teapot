<?php

namespace Aureola\LaravelTeapot\Tests;

use Aureola\LaravelTeapot\TeapotServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            TeapotServiceProvider::class,
        ];
    }
}
