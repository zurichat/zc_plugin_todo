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
use App\Http\Controllers\PluginInstallationController;
use App\Http\Controllers\SideBar\TodoController as SideBarTodoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskReminderController;
use App\Http\Controllers\TaskSearchController;
use App\Http\Controllers\TodoSearchController;

/*
| Here is where you can register API routes for your application. These
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// api to fetch all todo tasks
Route::prefix('v1')->group(function () {


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





    // api to assign and remove user from a todo room
    Route::get('task/assign/{user_id}', [AssignTaskUserController::class, 'assignedTask']);
    Route::post('task/assign', [AssignTaskUserController::class, 'assign']);
    Route::delete('task/remove/{user_id}', [AssignTaskUserController::class, 'remove']);

    // Collaborators Related Endpoints
    Route::put('assign-collaborators/{todoId}', [AssignUserController::class, 'assign']);
    Route::put('remove-collaborators/{todoId}', [AssignUserController::class, 'remove']);
    Route::get('get-collaborators/{todoId}', [AssignUserController::class, 'fetch']);
    // Admin privilege
    Route::put('admin-privilege/{todoId}', [AdminController::class, 'adminPrivilege']);



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


    Route::get('/demo-search', [TodoSearchController::class, 'search']);

    /**
     * Installation enpoints
     */
    Route::post('/install', [PluginInstallationController::class, 'install']);//->middleware('authenticate.plugin.user');
    Route::post('/uninstall', [PluginInstallationController::class, 'uninstall']);//->middleware('authenticate.plugin.user');



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

    // Add reminder to todotask
    Route::put('todo/{todo_id}/task/{task_id}/add-reminder', [TaskReminderController::class, 'addReminderToTask']);
    Route::put('todo/{todo_id}/task/{task_id}/remove-reminder/{reminder_id}', [TaskReminderController::class, 'removeReminderFromTask']);
    Route::get('test-cron-trigger', [TaskReminderController::class, 'commandHandler']);

    // Plugin Info Related Enpoints
    Route::get('sidebar', [SideBarItemsController::class, 'sidebar']);
    Route::get('info', [PluginInfoController::class, 'servePluginInfo']);
    Route::get('ping', function () {
        return response()->json(['message' => 'Server is live'], 200);
    });
});

// Sidevar without group
Route::get('sidebar', [SideBarItemsController::class, 'sidebar']);

// security
Route::prefix('security')->group(function () {
    // Authorization
    Route::get('/auth/verify-token', function () {
        $auth = "https://api.zuri.chat/auth/verify-token";
        return $auth?"auth":"error while fetching auth";
    });

    // Users
    Route::get('/users', function () {
        $user = "https://api.zuri.chat/users";
        return $user?"user":"error while fetching user";
    });

    // Data
    Route::get('/data/read/{plugin_id}/{coll_name}/{org_id}', function () {
        $data = "https://api.zuri.chat/{plugin_id}/{coll_name}/{org_id}";
        return $data?"task return":"error while fetching task";
    });

    // Organization
    Route::get('/organizations', function () {
        $organization = "https://api.zuri.chat/organizations";
        return $organization?"organization return":"error while fetching organization";
    });

    // Members
    Route::get('/organizations/{organization_id}/members/', function () {
        $member = "https://api.zuri.chat/organizations/{organization_id}/members";
        return $member?"member return":"error while fetching organization";
    });

    // Marketplace
    Route::get('/marketplace/plugins/{id}', function () {
        $marketplace = "https://api.zuri.chat/marketplace/plugins";
        return $marketplace?"error while fetching marketplace":"check";
    });

    // Zuriblog
    Route::get('/posts', function () {
        $zuri = "https://api.zuri.chat/posts";
        return $zuri?"error while fetching posts":"check";
    });

    // Todo Plugin
    Route::get('/todo', function () {
        $todo = "https://todo.zuri.chat/api/v1/todo/{todo_id}";
        return $todo?"error while fetching todos":"check";
    });

    // Calendar Plugin
    Route::get('/', function () {
        $zuri = "https://api.zuri.chat/";
        return $zuri?"error while fetching calendar":"check";
    });

    // Chess Plugin
    Route::get('/game', function () {
        $zuri = "https://chess.zuri.chat/api/v1";
        return $zuri?"error while fetching chess":"check";
    });

    // Chat Channel Plugin
    Route::get('/collections/{plugin_id}', function () {
        $zuri = "https://channels.zuri.chat/api/v1";
        return $zuri?"error while fetching chat channel":"check";
    });

    // Channel Plugin
    Route::get('/v1/collections/{plugin_id}/organizations{org_id}', function () {
        $zuri = "https://channels.zuri.chat/";
        return $zuri?"error while fetching channel":"check";
    });

    // Music Plugin
    Route::get('/music', function () {
        $zuri = "https://music.zuri.chat";
        return $zuri?"error while fetching music":"check";
    });

    // Goals Plugin
    Route::get('/', function () {
        $zuri = "https://goals.zuri.chat/api/v1";
        return $zuri?"error while fetching goals":"check";
    });

    // Sales Plugin
    Route::get('/sales', function () {
        $zuri = "http://sales.zuri.chat/api/v1";
        return $zuri?"error while fetching sales":"check";
    });

    // DM Chat Plugin
    Route::get('/dm', function () {
        $zuri = "http://dm.zuri.chat/";
        return $zuri?"error while fetching DMs":"check";
    });

    // Notice Board Plugin
    Route::get('/noticeboard', function () {
        $zuri = "http://noticeboard.zuri.chat/api";
        return $zuri?"error while fetching notice board":"check";
    });

    // Switch Workspaces/Organization Workflow
    Route::get('/switch', function () {
        $zuri = "http://zuri.chat/documentation/organization#tag/Organization";
        return $zuri?"error while switching workspace":"check";
    });

});
