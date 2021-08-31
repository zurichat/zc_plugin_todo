<?php

use App\Http\Controllers\PluginInfoController;
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
//..........route to remove team member assigned to a task...............//
Route::get('/memberAction',[MemberActionController::class, 'removeTeamMember']);
//.........route to add team member to a task............................//
Route::post('/memberAction',[MemberActionController::class, 'addTeamMember']);
