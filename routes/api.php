<?php

use App\Http\Controllers\PluginInfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskDemoControllers;
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

Route::get('task', [TaskDemoController::class, 'index']);
Route::get('task/{id}', [TaskDemoController::class, 'show']);
Route::post('task', [TaskDemoController::class, 'store']);
Route::put('task/{id}', [TaskDemoController::class, 'update']);
Route::delete('task/{id}', [TaskDemoController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/plugin-info', [PluginInfoController::class, 'servePluginInfo']);
