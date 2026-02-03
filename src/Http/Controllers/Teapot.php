<?php

namespace Aureola\LaravelTeapot\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Teapot
{
    public function __invoke(Request $request): void
    {
        if (is_teapot_request($request)) {
            abort(Response::HTTP_I_AM_A_TEAPOT);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
