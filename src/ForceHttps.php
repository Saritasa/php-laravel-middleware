<?php

namespace Saritasa\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * Redirect to HTTPS, if environment is not local.
 * Also force HTTPS schema for resource URLs (JS, CSS, etc.), when user on secure page,
 * to avoid errors, cased by browser protection (doesn't allow loading scrips over HTTP)
 */
class ForceHttps
{
    const HTTPS = 'https';

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

        if (!RequestChecker::isSecure($request)) {
            return redirect()->secure($request->getRequestUri());
        } else {
            $isOldLaravel = version_compare(app()->version(), '5.4.0', '<');

            if ($isOldLaravel) {
                URL::forceSchema(static::HTTPS);
            } else {
                URL::forceScheme(static::HTTPS);
            }
        }

        return $next($request);
    }
}
