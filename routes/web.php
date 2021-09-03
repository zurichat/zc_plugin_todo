<?php

use App\Http\Controllers\PluginInfoController;
use App\Http\Controllers\SideBarItemsController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskCommentController;
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