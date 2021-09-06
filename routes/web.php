<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskDemoController;
use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\assignTaskController;
use App\Http\Controllers\CommentDemoController;


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

//TaskCommentController
Route::delete('comment_delete/{id}', [\App\Http\Controllers\TaskCommentController::class,'delete']);


Route::get('/ping', function () {
    return response()->json(['message' => 'Server is Live!'], 200);
});
Route::get('/info', [PluginInfoController::class, 'servePluginInfo']);
Route::get('/sidebar', [SideBarItemsController::class, 'serveMenuItems']);

// comment blade to test comment post request
Route::get('/comment', function(){
    return view('create-comment');
});

//comment to edit test

Route::get('/editcomment/{id}', [CommentDemoController::class,'editcomment']);
// assign user to a task
Route::get('/task/assign', function(){
    return view('assign-user');
});

//This Fetch id of task for comment
Route::get('/comment/{id}',[TaskCommentController::class,'findTaskCommentById']);
Route::get('/task/comment/{id}',[TaskCommentController::class,'findTaskCommentByIdTest']);

//Resource route
Route::get('/taskresource', [App\Http\Controllers\TaskController::class, 'showResource']);






Route::get('/get-tasks', [TaskController::class, 'taskcollection']);

Route::get('/todo_resource', [TodoController::class, 'showResource']);




Route::get('/get-tasks', [TaskController::class, 'taskcollection']);

