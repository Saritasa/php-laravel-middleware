<?php

namespace Saritasa\Middleware;

use Closure;

/**
 * Check, that request made via AJAX
 */
class AjaxOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            return response('Bad Request', 422);
        }
        return $next($request);
    }
}
