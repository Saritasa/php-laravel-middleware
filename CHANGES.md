# Changes History

2.1.3
------
- Added support up to Laravel 11

2.1.2
------
- Added support up to Laravel 9

2.1.1
-----
Do not force HTTPS for 'testing' environment

2.1.0
-----
Declare compatibility with Laravel 6

2.0.0
-----
Exclude ApiAuthenticate from registration by service provider (conflicts with Dingo/Api), mark it as deprecated

1.0.7
-----
Enable Laravel's package discovery https://laravel.com/docs/5.5/packages#package-discovery

1.0.6
-----
Add RequestChecker utility to check if request is secure and contains header value or not

1.0.5
-----
Add AjaxOnly middleware

1.0.4
-----
Update dependencies versions

1.0.3
-----
- Update dependencies versions
- Use saritasa/roles-simple package for admin permissions check

1.0.2
-----
Add Service Provider, which registers aliases for middleware

1.0.1
-----
Make ForceHttps compatible both with Laravel 5.4 and older versions

1.0.0
-----
Initial version:
* ApiAuthenticate (with JWT)
* AdminAuthenticate
* ForceHttps
* NoCache
