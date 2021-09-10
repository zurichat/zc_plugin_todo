<?php

use App\Http\Controllers\AssignTaskUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\UploadFilesController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\Api\TodoResourceController;
use App\Http\Controllers\SideBar\TodoController as SideBarTodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskSearchController;

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



// api to fetch all todo tasks
Route::get('task', [TaskController::class, 'index']);
Route::get('task/{id}/show', [TaskController::class, 'show']);
Route::get('/task/modify/{id}', [TaskController::class, 'modifyShow']);
Route::post('/task/modify/{id}', [TaskController::class, 'updateTaskDate']);
Route::post('/task/update/category/{id}', [TaskController::class, 'updateTaskCategory']);
Route::get('/task/update/category/{id}', [TaskController::class, 'categoryTestView']);
Route::post('/task/update/{id}', [TaskController::class, 'editTask']);
Route::get('/getLatestTask', [TaskController::class, 'getLatestTask']);
Route::get('/todo_resource', [TodoController::class, 'showResource']);
Route::get('task/assign/{user_id}', [AssignTaskUserController::class, 'assignedTask']);
Route::post('task/assign', [AssignTaskUserController::class, 'assign']);

Route::get('task/sort', [TaskController::class, 'sort']);
Route::get('find-task/{id}', [TaskDemoController::class, 'show']);
Route::post('add-task', [TaskController::class, 'store']);
Route::put('update-task/{id}', [TaskDemoController::class, 'update']);
Route::delete('delete-task/{id}', [TaskDemoController::class, 'delete']);
Route::post('task/{id}/toggleArchiveStatus', [TaskController::class, 'toggleArchiveStatus']);
Route::get('/task_collection/{id}', [TaskController::class, 'sort']);
Route::get('/task/archived', [TaskController::class, 'archived']);
Route::post('/archive_task/{id}', [TaskController::class, 'archive']);
Route::get('/search', [TaskController::class, 'search_todo']);

// Resource End ponits
Route::get('/taskresource', [TaskController::class, 'showResource']);


// Comment Related Endpoints
Route::post('add-comment', [TaskCommentController::class, 'saveComment']);
Route::get('all-comment', [TaskCommentController::class, 'index']);
Route::get('comment/{taskId}', [TaskCommentController::class, 'getCommentsPerTask']);
Route::put('update-comment/{commentId}', [TaskCommentController::class, 'update']);
Route::delete('comment_delete/{commentId}', [TaskCommentController::class, 'delete']);


// File Related Endpoints

Route::post('files', [UploadFilesController::class, 'upLoadFiles']);
Route::get('viewfiles', [UploadFilesController::class, 'viewFile']);

// todo post request
Route::post('create', [TodoController::class, 'create']);
Route::post('edit', [TodoController::class, 'edit']);
Route::post('update', [TodoController::class, 'update']);

// Plugin Info Related Enpoints
Route::get('sidebar', [SideBarItemsController::class, 'serveMenuItems']);
Route::get('info', [PluginInfoController::class, 'servePluginInfo']);
Route::get('ping', function () {
    return response()->json(['message' => 'Server is live'], 200);
});




// Route::prefix('v1')->middleware(['authenticate.plugin.user'])->group(function () {
Route::prefix('v1')->group(function () {
    Route::get('/todo', [SideBarTodoController::class, 'index']);
    Route::post('/todo', [SideBarTodoController::class, 'store']);
    Route::delete('/todo', [SideBarTodoController::class, 'delete']);
    Route::get('/sidebar', [SideBarTodoController::class, 'sidebar']);
});
 Route::get('/v1/all-rooms', [SideBarTodoController::class, 'allRooms']);
 Route::get('/v1/users-in-room', [SideBarTodoController::class, 'usersInRoom']);
// Route::delete('v1/all-rooms/{room_id}', [SideBarTodoController::class, 'deleteRoom']);
