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
        'no-cache'  => NoCache::class,
        'admin'     => AdminAuthenticate::class,
        'ajax-only' => AjaxOnly::class
    ];

    public function boot(Router $router)
    {
        foreach ($this->routeMiddleware as $alias => $class) {
            $router->aliasMiddleware($alias, $class);
        }
    }
}
