<?php

namespace Delivery\Http\Middleware;

use Closure;

class CorsHeadersInsert
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
        if ($request->is('oauth/*')) {
            header("Access-Control-Allow-Origin: *");       
        }

        return $next($request);
    }
}
