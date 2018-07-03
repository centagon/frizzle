<?php

namespace Centagon\Frizzle\Http\Middleware;

use Centagon\Frizzle\Frizzle;

class AuthenticateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        return Frizzle::bearer($request) ? $next($request) : abort(403);
    }
}
