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

        if (!$this->isSecure($request)) {
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

    /**
     * Determine, if request was made over secure channel (over HTTPS),
     * including detection of proxy/load balancer, which terminates SSL and forwards HTTP only
     *
     * @param  Request $request HTTP Request
     * @return boolean
     */
    private function isSecure(Request $request)
    {
        return $request->secure()
            || $this->headerContains($request, 'HTTP_X_FORWARDED_PROTO', static::HTTPS)
            || $this->headerContains($request, 'X-Forwarded-Proto', static::HTTPS);
    }

    /**
     * Determine, if specified header has expected value,
     * including case, when actual value is an array - then at leas one string in array must match expected value
     *
     * @param  Request $request       HTTP Request
     * @param  string  $headerName    Name of checked header
     * @param  string  $expectedValue Expected value
     * @return boolean
     */
    private function headerContains(Request $request, string $headerName, string $expectedValue): bool
    {
        $actualValue = $request->header($headerName);
        if ($actualValue) {
            if (is_string($actualValue)) {
                return strcasecmp($expectedValue, $actualValue) == 0;
            }
            if (is_array($actualValue)) {
                foreach ($actualValue as $proto) {
                    return strcasecmp($expectedValue, $proto) == 0;
                }
            }
        }
        return false;
    }
}
