<?php

use App\collectionTasksMonthSort;
use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


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
Route::get('/create-todo', [TodoController::class, 'showPage'])->name('show.create-todo');

Route::post('/create-todo', [TodoController::class, 'store']);
Route::get('testRoute', [TodoController::class, 'showtest']);
Route::post('edit', [TodoController::class, 'edit']);
Route::post('sort', [collectionTasksMonthSort::class,'store']);
Route::post('update', [\App\Http\Controllers\TodoController::class, 'update']);



Route::get('/todo', [TodoController::class, 'index'])->name('get-todo');

Route::get('/ping', function () {
    return response()->json(['message' => 'Server is Live!'], 200);
});
Route::get('/info', [PluginInfoController::class, 'servePluginInfo']);
Route::get('/sidebar', [SideBarItemsController::class, 'serveMenuItems']);


