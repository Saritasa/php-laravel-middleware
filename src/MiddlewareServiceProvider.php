<?php

namespace Saritasa\Middleware;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Register middleware with aliases
 */
class MiddlewareServiceProvider extends ServiceProvider
{
    protected $routeMiddleware = [
        'ssl'       => ForceHttps::class,
        'api.auth'  => ApiAuthenticate::class,
        'no-cache'  => NoCache::class,
        'admin'     => AdminAuthenticate::class
    ];

    public function boot(Router $router)
    {
        foreach ($this->routeMiddleware as $alias => $class) {
            $router->aliasMiddleware($alias, $class);
        }
    }
}
