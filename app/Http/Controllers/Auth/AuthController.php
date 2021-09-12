<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
  protected $url = 'https://api.zuri.chat/auth/login';

  function __construct()
  {

  }

    public function login(Request $request)
    {
       $response = Http::post($this->url, [
        'email' => $request->email,
        'password' => $request->password,
       ], ['cookies' => true]);

       return response($response->json());
    }

}
