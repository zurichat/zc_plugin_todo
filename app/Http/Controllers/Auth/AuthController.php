<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
  protected $url = 'https://api.zuri.chat/auth/login';

    public function login(Request $request)
    {
       $response = Http::post($this->url, [
            'email' => $request->email,
            'password' => $request->password,
        ], ['cookies' => true]);
       return response()->json($response, 200)->header('Set-Cookie', $response->headers()['Set-Cookie']);
    }

}
