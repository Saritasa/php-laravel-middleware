<?php

namespace Saritasa\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Saritasa\Database\Eloquent\Models\User;
use Saritasa\Roles\Enums\Roles;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::guard($guard)->user();
        if (!$user || $user->hasRole(Roles::ADMIN)) {
            if ($request->ajax()) {
                return response('Unauthorized.', $user ? Response::HTTP_FORBIDDEN : Response::HTTP_UNAUTHORIZED);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}