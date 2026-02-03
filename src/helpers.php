<?php

use Illuminate\Http\Request;

if (!function_exists('is_teapot_request')) {
    function is_teapot_request(Request $request): bool
    {
        if (config('teapot.ignore_logged_in', false) && $request->user() !== null) {
            return false;
        }

        $paths = config('teapot.paths', []);
        if (empty($paths)) {
            return false;
        }
        
        $pattern = '/^(' . implode('|', $paths) . ')/i';
        return (bool) preg_match($pattern, $request->path());
    }
}
