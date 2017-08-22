<?php

namespace Saritasa\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Check, that request made via AJAX
 */
class AjaxOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request HTTP Request to process
     * @param  Closure $next Next handler in chain
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax()) {
            return response('Bad Request', 422);
        }
        return $next($request);
    }
}
