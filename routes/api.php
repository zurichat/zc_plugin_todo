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

// - Task Related Endpoints --------------//

Route::get('task/sort', [\App\Http\Controllers\TaskController::class, 'sort']);
Route::get('get-tasks', [\App\Http\Controllers\TaskDemoController::class, 'index']);
Route::get('find-task/{id}', [\App\Http\Controllers\TaskDemoController::class, 'show']);
Route::post('add-task', [\App\Http\Controllers\TaskDemoController::class, 'store']);
Route::put('update-task/{id}', [\App\Http\Controllers\TaskDemoController::class, 'update']);
Route::delete('delete-task/{id}', [\App\Http\Controllers\TaskDemoController::class, 'delete']);


// -  Comment Related Endpoints ----------- //

Route::post('add-comment', [TaskCommentController::class, 'saveComment']);
Route::get('all-comment', [TaskCommentController::class, 'index']);
Route::get('comment/{taskId}', [TaskCommentController::class, 'getCommentsPerTask']);
Route::put('update-comment/{commentId}', [TaskCommentController::class, 'update']);
Route::delete('comment_delete/{commentId}', [TaskCommentController::class, 'delete']);


// ----------- File Related Endpoints --------------------- //

Route::post('files', [UploadFilesController::class, 'upLoadFiles']);
Route::get('viewfiles', [UploadFilesController::class, 'viewFile']);





Route::get('task-category', [TaskController::class, 'getTasksByCategory']);

// api to fetch all todo tasks
Route::get('task', [\App\Http\Controllers\TaskController::class, 'index']);

// comment post request




Route::post('create', [\App\Http\Controllers\TodoController::class, 'create']);
Route::post('edit', [\App\Http\Controllers\TodoController::class, 'edit']);
Route::post('update', [\App\Http\Controllers\TodoController::class, 'update']);
Route::get('/search', [TodoController::class, 'search_todo']);



Route::get('task/{id}/show', [\App\Http\Controllers\TaskController::class, 'show']);
Route::post('task/{id}/toggleArchiveStatus', [\App\Http\Controllers\TaskController::class, 'toggleArchiveStatus']);
// -------------- Task Modification Endpoints --------------------- //
Route::get('/task/modify/{id}', [\App\Http\Controllers\TaskController::class, 'modifyShow']);
Route::post('/task/modify/{id}', [\App\Http\Controllers\TaskController::class, 'updateTaskDate']);
Route::post('/task/update/category/{id}', [\App\Http\Controllers\TaskController::class, 'updateTaskCategory']);
Route::get('/task/update/category/{id}', [\App\Http\Controllers\TaskController::class, 'categoryTestView']);


Route::post('/task/update/{id}', [\App\Http\Controllers\TaskController::class, 'editTask']);







Route::get('/getLatestTask', [TaskController::class, 'getLatestTask']);

//------------------- Resource End ponits ---------- //
Route::get('/taskresource', [App\Http\Controllers\TaskController::class, 'showResource']);


// endpoint to fetch user credentials
Route::get('/users', function () {
    return response()->json(['message' => 'route to fetch user credentials is working'], 200);
});

//Show Tasks Assigned to a Specific User
Route::get('task/assign/{user_id}', [AssignTaskUserController::class, 'assignedTask']);

Route::post('task/assign', [AssignTaskUserController::class, 'assign']);

//Route to get collection of tasks for a user by id
Route::get('/task_collection/{id}', function () {
    return response()->json(['message' => 'route to get task collection is working'], 200);
});
Route::get('/task_collection/{id}', [TaskController::class, 'sort']);

Route::get('/task/archived', [TaskController::class, 'archived']);
Route::post('/archive_task/{id}', [TaskController::class, 'archive']);