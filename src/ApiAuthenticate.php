<?php

namespace Saritasa\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Check authentication for API request
 */
class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request HTTP Request to process
     * @param  Closure $next Next handler in chain
     * @param  string  $guard name of guard, that checks security access (verify user authentication)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return response('Unauthorized.', 401, ['Content-Type: application/json']);
        }

        return $next($request);
    }
}
