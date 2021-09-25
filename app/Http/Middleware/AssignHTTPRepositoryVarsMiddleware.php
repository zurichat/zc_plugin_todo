<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
        // check if organsation_id is missig
        if(!$request->has('organisation_id')){
            return response()->json(['error' => 'Organisation id is required'], 422);
        }
        // store variables
        Config::set('organisation_id', $request->organisation_id);
        Config::set('plugin_id', $request->plugin_id);
        Config::set('user_id', $request->user_id);
        // continue
        return $next($request);
    }
}
