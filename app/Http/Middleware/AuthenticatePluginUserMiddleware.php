<?php

namespace App\Http\Middleware;

use App\Repositories\AuthRepository;
use Closure;
use Illuminate\Http\Request;

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
        if(!$request->token){
            return response()->json(['error' => 'Authentication Error: TOKEN MISSING.'], 401);
        }
        if(!$request->user){
            return response()->json(['error' => 'Authentication Error: USER_ID MISSING.'], 401);
        }
        // data attr
        $attr = ['user_id' => $request->user, 'token' => $request->token];
        // authenticate user
        $res = $this->authRepository->authenticateUser($attr);
    
        // check response
        if($res['status'] == 200){
            // authentication successful
            return $next($request);
        }else{
            return response()->json(['error' => 'Authentication Error: ' . strtoupper($res['message'])], $res['status']);
        }
    }
}
