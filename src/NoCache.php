<?php

namespace Saritasa\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Set HTTP headers, instructing browser and proxy to disable caching of response
 */
class NoCache
{
    /**
     * @param Request $request HTTP Request
     * @param Closure $next    Next middleware handler
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }
}
