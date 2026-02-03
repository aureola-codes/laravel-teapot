<?php

namespace Aureola\LaravelTeapot;

use Aureola\LaravelTeapot\Http\Controllers\Teapot;
use Aureola\LaravelTeapot\Http\Middleware\CheckTeapot;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class TeapotServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/teapot.php', 'teapot');
    }

    public function boot(Router $router): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/teapot.php' => $this->app->configPath('teapot.php'),
            ], 'teapot-config');
        }

        $router->middlewareGroup('statamic.web', [
            CheckTeapot::class,
        ]);

        $router->fallback(Teapot::class);
    }
}
