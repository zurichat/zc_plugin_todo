<?php

use App\Http\Controllers\PluginInfoController;
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

Route::get('/plugin-info', [PluginInfoController::class, 'servePluginInfo']);

Route::post('create', [\App\Http\Controllers\PluginInfoController::class, 'create']);
Route::post('edit', [\App\Http\Controllers\PluginInfoController::class, 'edit']);
Route::post('update', [\App\Http\Controllers\PluginInfoController::class, 'update']);