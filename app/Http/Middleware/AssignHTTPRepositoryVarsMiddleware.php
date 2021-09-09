<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AssignHTTPRepositoryVarsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // store session vars
        session(['organisation_id' => $request->org]);
        session(['plugin_id' => $request->plugin_id]);
        return $next($request);
    }
}
