<?php

namespace Delivery\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ApiCheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user->role != $role) {
            abort(403, 'Access Forbidden');
        }

        return $next($request);
    }
}
