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

Route::get('task', [\App\Http\Controllers\TaskDemoController::class, 'index']);
Route::get('task/{id}', [\App\Http\Controllers\TaskDemoController::class, 'show']);
Route::post('task', [\App\Http\Controllers\TaskDemoController::class, 'store']);
Route::put('task/{id}', [\App\Http\Controllers\TaskDemoController::class, 'update']);
Route::delete('task/{id}', [\App\Http\Controllers\TaskDemoController::class, 'delete']);

Route::post('files', [UploadFilesController::class, 'upLoadFiles']);

Route::get('task-category',[TaskController::class,'getTasksByCategory']);

// comment post request
Route::post('comment', [\App\Http\Controllers\TaskCommentController::class, 'store']);


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
Route::post('/task/update/category/{id}', [\App\Http\Controllers\TaskController::class, 'updateTaskCategory']);
Route::get('/task/update/category/{id}', [\App\Http\Controllers\TaskController::class, 'categoryTestView']);


//test endpoint that reads request from zuri core
Route::get('test', [\App\Http\Controllers\TestController::class, 'index']);


Route::get('/plugin-info', [PluginInfoController::class, 'servePluginInfo']);

// -------------- Comments endpoints --------------------- //
Route::get('comment/{id}', [\App\Http\Controllers\TaskCommentController::class, 'show']);
Route::post('/comment', [\App\Http\Controllers\TaskCommentController::class, 'store']);
Route::put('comment/{id}', [\App\Http\Controllers\TaskCommentController::class, 'update']);

Route::get('/getLatestTask', [TaskController::class, 'getLatestTask']);
//------------------- Resource End ponits ---------- //
Route::get('/todo_resource', [TodoController::class, 'showResource']);


// endpoint to fetch user credentials
Route::get('/users', function(){
    return response()->json(['message' => 'route to fetch user credentials is working'], 200);
});

