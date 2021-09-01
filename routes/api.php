<?php

use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\SideBarItemsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    return response()->json(['message' => 'Server is Live!'], 200);
});

Route::get('/info', [PluginInfoController::class, 'servePluginInfo']);
Route::get('/sidebar', [SideBarItemsController::class, 'serveMenuItems']);
