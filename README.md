# Aureola Laravel Teapot

Responds with **HTTP 418 I'm a Teapot** when a request hits a teapot path. Use with [fail2ban](https://www.fail2ban.org/) to ban those IPs.

## How it works

- You list path patterns in `config/teapot.php`.
- If the request path matches, the app returns **418** (via the fallback for unmatched URLs).
- Your server logs 418; fail2ban reads the log and bans the IP.

## Installation

```bash
composer require aureola/laravel-teapot
```

Nothing else to do; the package registers itself.

## Configuration

Publish and edit the config:

```bash
php artisan vendor:publish --tag=teapot-config
```

`paths` is an array of **regex alternatives** (matched from the start of the path, case-insensitive). Escape special chars for literals: `\.` for a dot, `\/` for a slash.

```php
'paths' => [
    '\.env',
    '\.git\/',
    'wp-admin',
    '\.env(\..*)?',
    // ...
],
```

**ignore_logged_in** – when `true`, authenticated users are never treated as teapot hits.

## Fail2ban

This repo includes fail2ban configs in **`fail2ban/`**:

- **Nginx:** copy `fail2ban/filter.d/nginx-teapot.conf` and `fail2ban/jail.d/nginx-teapot.conf` to `/etc/fail2ban/filter.d/` and `/etc/fail2ban/jail.d/`.
- **Apache:** copy `fail2ban/filter.d/apache-teapot.conf` and `fail2ban/jail.d/apache-teapot.conf` instead. Adjust `logpath` in the jail if your access log is elsewhere.

Then restart fail2ban: `sudo fail2ban-client restart`

## What the package registers

A **fallback** for unmatched URLs: 418 if the path matches a teapot pattern, 404 otherwise.

## Statamic Compatibility

This package is compatible with [Statamic CMS](https://statamic.com/). When Statamic is installed, the package automatically adds the `CheckTeapot` middleware to the `statamic.web` middleware group, ensuring teapot paths are checked on all Statamic web requests.

## Requirements

- PHP 8.1+
- Laravel 10.x, 11.x, or 12.x

## License

MIT License, Copyright (c) 2026 Christian Hanne
