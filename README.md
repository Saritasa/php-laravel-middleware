# Laravel Middleware

[![Build Status](https://travis-ci.org/Saritasa/php-laravel-middleware.svg?branch=master)](https://travis-ci.org/Saritasa/php-laravel-middleware)
[![Release](https://img.shields.io/github/release/saritasa/php-laravel-middleware.svg)](https://github.com/Saritasa/php-laravel-middleware/releases)
[![PHPv](https://img.shields.io/packagist/php-v/saritasa/laravel-middleware.svg)](http://www.php.net)
[![Downloads](https://img.shields.io/packagist/dt/saritasa/laravel-middleware.svg)](https://packagist.org/packages/saritasa/laravel-middleware)

Middleware classes for Laravel

## Laravel 5.x

Install the ```saritasa/laravel-middleware``` package:

```bash
$ composer require saritasa/laravel-middleware
```

**Optionally**
If you use Laravel 5.4 or less,
or 5.5+ with [package discovery](https://laravel.com/docs/5.5/packages#package-discovery) disabled,
add the MiddlewareServiceProvider in ``config/app.php``:

```php
'providers' => array(
    // ...
    Saritasa\Middleware\MiddlewareServiceProvider::class,
)
```

It will register default aliases (middleware-key) for all middleware classes

Alternatively, you can just register selected middleware classes in
*App\Http\Kernel.php* yourself

See https://laravel.com/docs/middleware#registering-middleware

## Available classes
ClassName / middleware-key

### ForceHttps / ssl
This middleware has 2 effects:
1. If user tries to access website over HTTP protocol, redirect him to HTTPS.
2. If request already is made over SSL, force HTTPS URL schema for all generated URLs.

Exception: if APP_ENV is set to 'local'.

This solves 2 problems:
1. Application can be accessed via insecure protocol
2. When application is behind proxy or load balancer, which terminates SSL, standard
Laravel classes do not detect it correctly, and generate HTTP links to static
resources (JS, CSS) - as result browser blocks them as insecure.

### NoCache / no-cache
Insert HTTP headers, preventing content caching on proxy or in browser.

### AdminAuthenticate / admin
Checks, that user has role = 'admin'. If not, access is denied.

### AjaxOnly / ajax-only
If request was not made via AJAX (with XMLHttpRequest), return 'Bad Request' error.

## Contributing

1. Create fork, checkout it
2. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)** -
    run [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to ensure, that code follows style guides
3. **Cover added functionality with unit tests** and run [PHPUnit](https://phpunit.de/) to make sure, that all tests pass
4. Update [README.md](README.md) to describe new or changed functionality
5. Add changes description to [CHANGES.md](CHANGES.md) file. Use [Semantic Versioning](https://semver.org/) convention to determine next version number.
6. When ready, create pull request

### Make shortcuts

If you have [GNU Make](https://www.gnu.org/software/make/) installed, you can use following shortcuts:

* ```make cs``` (instead of ```php vendor/bin/phpcs```) -
    run static code analysis with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    to check code style
* ```make csfix``` (instead of ```php vendor/bin/phpcbf```) -
    fix code style violations with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    automatically, where possible (ex. PSR-2 code formatting violations)
* ```make test``` (instead of ```php vendor/bin/phpunit```) -
    run tests with [PHPUnit](https://phpunit.de/)
* ```make install``` - instead of ```composer install```
* ```make all``` or just ```make``` without parameters -
    invokes described above **install**, **cs**, **test** tasks sequentially -
    project will be assembled, checked with linter and tested with one single command

## Resources

* [Bug Tracker](http://github.com/saritasa/php-laravel-middleware/issues)
* [Code](http://github.com/saritasa/php-laravel-middleware)
* [Changes History](CHANGES.md)
* [Authors](http://github.com/saritasa/php-laravel-middleware/contributors)
