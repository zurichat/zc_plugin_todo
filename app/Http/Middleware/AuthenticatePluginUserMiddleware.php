<?php

namespace App\Http\Middleware;

use App\Repositories\AuthRepository;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AuthenticatePluginUserMiddleware
{
    protected $authRepository;

    function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null($request->token) && is_null($request->header('Authorization'))) {
            return response()->json(['error' => 'Authentication Error: TOKEN MISSING.'], 401);
        }

        // data attr
        $token = explode(' ', $request->header('Authorization'));

        if (!is_array($token) || !count($token) > 1) {
            return response()->json(['error' => 'Authentication Error: TOKEN MISSING.'], 401);
        }

        $attr = ['user_id' => $request->user ?? $request->user_id, 'token' => $token[1] ?? $request->token];

        // authenticate user
        $res = $this->authRepository->authenticateUser($attr);
        // dd($res);
        // check response
        if ($res['status'] == 200) {
            // authentication successful
            $this->storeToken($token);

            return $next($request);
        } else {
            return response()->json(['error' => 'Authentication Error: ' . strtoupper($res['message'])], $res['status']);
        }
    }

    private function storeToken($token)
    {
        Config::set('token', $token);
    }
}
