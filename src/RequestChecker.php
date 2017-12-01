<?php

namespace Saritasa\Middleware;

/**
 * Requests helper utility. Allows to check is request secure and check request's header value.
 */
class RequestChecker
{
    /**
     * Determine, if request was made over secure channel (over HTTPS),
     * including detection of proxy/load balancer, which terminates SSL and forwards HTTP only
     *
     * @param \Illuminate\Http\Request $request HTTP Request
     * @return boolean
     */
    public static function isSecure(\Illuminate\Http\Request $request)
    {
        return $request->secure()
            || static::headerContains($request, 'HTTP_X_FORWARDED_PROTO', 'https')
            || static::headerContains($request, 'X-Forwarded-Proto', 'https');
    }

    /**
     * Determine, if specified header has expected value,
     * including case, when actual value is an array - then at leas one string in array must match expected value
     *
     * @param  \Illuminate\Http\Request $request HTTP Request
     * @param  string $headerName Name of checked header
     * @param  string $expectedValue Expected value
     * @return boolean
     */
    public static function headerContains(\Illuminate\Http\Request $request, string $headerName, string $expectedValue): bool
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