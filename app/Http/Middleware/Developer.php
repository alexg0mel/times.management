<?php

namespace App\Http\Middleware;

use Closure;

class Developer
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
        \header('X-Developer:alexgomel@tut.by');
        return $next($request);
    }
}
