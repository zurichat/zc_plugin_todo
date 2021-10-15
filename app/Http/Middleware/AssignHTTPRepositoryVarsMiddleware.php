<?php

namespace App\Http\Middleware;

use App\Constants\AppConstants;
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
        // check if route is API route
        if ($this->isAPIRoute($request->getPathInfo())) {
            // check if request has organisation id
            if ($this->hasOrganisationID($request)) {
                $this->storeVars($request);
            } else {
                return response()->json(['error' => 'Organisation id is required'], 422);
            }
        }

        // continue
        return $next($request);
    }

    /**
     * Check if route is an api route
     */
    private function isAPIRoute(string $routePath)
    {
        $routePathArray = explode('/', trim($routePath));
        return in_array('api', $routePathArray) ? true : false;
    }

    /**
     * Store vars
     */
    private function storeVars($request)
    {
        // store variables
        Config::set('organisation_id', $request->organisation_id ?? $request->org ?? $request->org_id);
        Config::set('plugin_id', AppConstants::PLUGIN_ID);
        Config::set('user_id', $request->user_id ?? $request->user);
    }

    /**
     * Check if request has organisation id
     */
    public function hasOrganisationID($request)
    {
        return $request->has('organisation_id') || $request->has('org') || $request->has('org_id');
    }
}
