<?php

use App\Http\Controllers\PluginInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;


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
Route::get('/todo', [TodoController::class, 'index'])->name('get-todo');