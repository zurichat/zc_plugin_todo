<?php

use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\assignTaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/plugin-info', [PluginInfoController::class, 'servePluginInfo']);


Route::get('task-email-notification', [assignTaskController::class, 'sendEmailNotification']);

Route::get('/create-todo', [TodoController::class, 'showPage'])->name('show.create-todo');
Route::post('/create-todo', [TodoController::class, 'store'])->name('create-todo');



Route::get('/todo', [TodoController::class, 'index'])->name('get-todo');

Route::get('/ping', function () {
    return response()->json(['message' => 'Server is Live!'], 200);
});
Route::get('/info', [PluginInfoController::class, 'servePluginInfo']);
Route::get('/sidebar', [SideBarItemsController::class, 'serveMenuItems']);

// comment blade to test comment post request
Route::get('/comment', function(){
    return view('create-comment');
});

// assign user to a task
Route::get('/task/assign', function(){
    return view('assign-user');
});

//This Fetch id of task for comment
Route::get('/comment/{id}',[TaskCommentController::class,'findTaskCommentById']);
Route::get('/task/comment/{id}',[TaskCommentController::class,'findTaskCommentByIdTest']);

//Resource route
Route::get('/{id}/comment', function ($id) {
    return view('comment',compact('id'));
});
Route::apiResource('todo_resource', \App\Http\Controllers\API\TodoResourceController::class)->only('index');