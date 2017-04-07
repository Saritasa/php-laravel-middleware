# Laravel Middleware

Middleware classes for Laravel

## Laravel 5.x

Install the ```saritasa/laravel-middleware``` package:

```bash
$ composer require saritasa/middleware
```

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

## Contributing

1. Create fork
2. Checkout fork
3. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)**
4. Update README.md to describe new or changed functionality. Add changes description to CHANGE file.
5. When ready, create pull request

## Resources

* [Bug Tracker](http://github.com/saritasa/php-transformers/issues)
* [Code](http://github.com/saritasa/php-transformers)
