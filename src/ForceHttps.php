<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Redirect to HTTPS, if environment is not local.
 * Also force HTTPS schema for resource URLs (JS, CSS, etc.), when user on secure page,
 * to avoid errors, cased by browser protection (doesn't allow loading scrips over HTTP)
 */
class ForceHttps
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
        if (config('app.env') === 'local' || config('app.env') === 'vagrant') {
            return $next($request);
        }

        if (!$this->isSecure($request)) {
            return redirect()->secure($request->getRequestUri());
        }
        else {
            \URL::forceSchema('https');
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function isSecure(Request $request)
    {
        return $request->secure()
            || $request->header('HTTP_X_FORWARDED_PROTO') == 'https'
            || $request->header('X-Forwarded-Proto') == 'https';
    }
}
