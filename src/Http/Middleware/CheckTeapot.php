<?php

namespace Aureola\LaravelTeapot\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTeapot
{
    public function handle(Request $request, Closure $next): Response
    {
        if (is_teapot_request($request)) {
            abort(Response::HTTP_I_AM_A_TEAPOT);
        }

        return $next($request);
    }
}
