<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use Symfony\Component\VarDumper\VarDumper;
use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\UploadFilesController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TaskController;

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
Route::post('create', [\App\Http\Controllers\TodoController::class, 'create']);
Route::post('edit', [\App\Http\Controllers\TodoController::class, 'edit']);
Route::post('update', [\App\Http\Controllers\TodoController::class, 'update']);
Route::get('/search', [TodoController::class, 'search_todo']);

// -------------- Plugin Information Endpoints --------- //
Route::get('/ping', function () {
    return response()->json(['message' => 'Server is Live!'], 200);
});
Route::get('/info', [PluginInfoController::class, 'servePluginInfo']);
Route::get('/sidebar', [SideBarItemsController::class, 'serveMenuItems']);

Route::get('task/{id}', [\App\Http\Controllers\TaskController::class, 'show']);
// -------------- Task Modification Endpoints --------------------- //
Route::get('/task/modify/{id}', [\App\Http\Controllers\TaskController::class, 'modifyShow']);
Route::post('/task/modify/{id}', [\App\Http\Controllers\TaskController::class, 'updateTaskDate']);
//test endpoint that reads request from zuri core
Route::get('test', [\App\Http\Controllers\TestController::class, 'index']);


Route::get('/plugin-info', [PluginInfoController::class, 'servePluginInfo']);