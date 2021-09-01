<?php

use App\Http\Controllers\PluginInfoController;
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

Route::get('/create-todo', [TodoController::class, 'show'])->name('show.create-todo');
Route::post('/create-todo', [TodoController::class, 'create'])->name('create-todo');
