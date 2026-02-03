<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ignore logged-in users
    |--------------------------------------------------------------------------
    |
    | When true, authenticated users are never treated as teapot hits and
    | will not receive 418 or get blocked by fail2ban for teapot paths.
    |
    */

    'ignore_logged_in' => env('TEAPOT_IGNORE_LOGGED_IN', false),

    /*
    |--------------------------------------------------------------------------
    | Teapot paths
    |--------------------------------------------------------------------------
    |
    | Regex alternatives matched at the start of the request path (case-
    | insensitive). Escape special chars for literals, e.g. \. for dot.
    |
    */

    'paths' => [
        '.*\.(sql|zip|tar|gz|bak)',
        '.*\/(c99|r57|shell|cmd)\.php',
        '\.(svn|hg)\/',
        '\.env',
        '\.env(\..*)?',
        '\.env\.backup',
        '\.env\.local',
        '\.env\.production',
        '\.git\/',
        '\.gitignore',
        '\.hg\/',
        '\.htaccess',
        '\.htpasswd',
        '\.sql',
        '\.svn\/',
        '\.well-known\/',
        'backup\.(zip|tar|gz)',
        'backup\.sql',
        'c99\.php',
        'cmd\.php',
        'config\.php',
        'crossdomain\.xml',
        'dump\.sql',
        'elmah\.axd',
        'phpinfo\.php',
        'phpmyadmin',
        'pma\/',
        'r57\.php',
        'robots\.txt',
        'security\.txt',
        'server-info',
        'server-status',
        'shell\.php',
        'storage\/.*\.(log|sql)',
        'trace\.axd',
        'vendor\/.*\.(php|sql|log)',
        'web\.config',
        'wp-(admin|login|content|includes)',
        'wp-admin',
        'wp-content',
        'wp-includes',
        'wp-login\.php',
        'xmlrpc\.php',
    ],

];
