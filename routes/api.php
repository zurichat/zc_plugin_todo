<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingContoller;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\UploadFilesController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\Api\TodoResourceController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AssignUserController;
use App\Http\Controllers\AssignTaskUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SideBar\TodoController as SideBarTodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskSearchController;

/*
| Here is where you can register API routes for your application. These
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// api to fetch all todo tasks
Route::prefix('v1')->group(function () {

    //test cache
    Route::post('create-todo/cache', [TodoController::class, 'cacheCreateTodo']);
    Route::get('all-todo/cache', [TodoController::class, 'cacheIndex']);
    Route::get('user-todo/cache', [TodoController::class, 'cacheUserTodos']);

    //end of test cache

    Route::post('create-todo', [TodoController::class, 'createTodo']);
    Route::get('all-todo', [TodoController::class, 'index']);
    Route::get('user-todo', [TodoController::class, 'userTodos']);

    Route::get('task', [TaskController::class, 'index']);
    Route::get('task/{id}/show', [TaskController::class, 'show']);
    Route::get('todo/{id}/{user_id}/show', [TodoController::class, 'getTodo']);
    Route::get('/task/modify/{id}', [TaskController::class, 'modifyShow']);
    Route::post('/task/modify/{id}', [TaskController::class, 'updateTaskDate']);
    Route::post('/task/update/category/{id}', [TaskController::class, 'updateTaskCategory']);
    Route::get('/task/update/category/{id}', [TaskController::class, 'categoryTestView']);
    Route::post('/task/update/{id}', [TaskController::class, 'editTask']);
    Route::get('/getLatestTask', [TaskController::class, 'getLatestTask']);
    Route::get('/todo_resource', [TodoController::class, 'showResource']);

    Route::put('add-task/{todoId}', [TaskController::class, 'addTask']);
    Route::put('/mark-task/{todoId}', [TaskController::class, 'markTask']);
    Route::delete('/todo/{todoId}/delete/{user_id}', [TodoController::class, 'delete']);
    Route::put('/todo-update/{todoId}/{user_id}', [TodoController::class, 'updateTodo']);


    // Admin privilege
    Route::put('admin-privilege/{todoId}', [AdminController::class, 'adminPrivilege']);

    // api to assign and remove user from a todo room
    Route::get('task/assign/{user_id}', [AssignTaskUserController::class, 'assignedTask']);
    Route::post('task/assign', [AssignTaskUserController::class, 'assign']);
    Route::delete('task/remove/{user_id}', [AssignTaskUserController::class, 'remove']);

    // Collaborators Related Endpoints
    Route::put('assign-collaborators/{todoId}', [AssignUserController::class, 'assign']);
    Route::delete('remove-collaborators/{todoId}', [AssignUserController::class, 'remove']);


    // Archiving Endpoints
    Route::put('archive-todo/{todoId}', [ArchiveController::class, 'archiveTodo']);
    Route::get('get-archived', [ArchiveController::class, 'fetchArchived']);
    Route::put('unarchive-todo/{todoId}', [ArchiveController::class, 'unArchiveTodo']);
    // Archiving Endpoints
    Route::put('archive-all', [ArchiveController::class, 'all']);


    Route::get('task/sort', [TaskController::class, 'sort']);
    Route::get('find-task/{id}', [TaskDemoController::class, 'show']);
    Route::post('add-task', [TaskController::class, 'store']);
    Route::put('update-task/{id}', [TaskDemoController::class, 'update']);
    Route::delete('delete-task/{id}', [TaskDemoController::class, 'delete']);

    Route::get('/task_collection/{id}', [TaskController::class, 'sort']);
    Route::get('/task/archived', [TaskController::class, 'archived']);
    Route::post('/archive_task/{id}', [TaskController::class, 'archive']);
    Route::get('/search', [TodoController::class, 'search_todo']);




    // Resource End ponits
    Route::get('/taskresource', [TaskController::class, 'showResource']);

    // Comment Related Endpoints
    Route::post('add-comment/{todoId}', [TaskCommentController::class, 'saveComment']);
    Route::get('comment/{taskId}', [TaskCommentController::class, 'getCommentsPerTask']);
    Route::get('todo-comment/{todo}', [TaskCommentController::class, 'getCommentPerTodo']);
    Route::put('update-comment/{commentId}/{channel}', [TaskCommentController::class, 'update']);


    // File Related Endpoints
    Route::post('files', [UploadFilesController::class, 'upLoadFiles']);
    Route::get('viewfiles', [UploadFilesController::class, 'viewFile']);

    // todo post request
    Route::post('create', [TodoController::class, 'create']);
    Route::post('edit', [TodoController::class, 'edit']);
    Route::post('update', [TodoController::class, 'update']);

    // Plugin Info Related Enpoints
    Route::get('sidebar', [SideBarItemsController::class, 'sidebar']);
    Route::get('info', [PluginInfoController::class, 'servePluginInfo']);
    Route::get('ping', function () {
        return response()->json(['message' => 'Server is live'], 200);
    });
});

// Sidevar without group
Route::get('sidebar', [SideBarItemsController::class, 'sidebar']);
