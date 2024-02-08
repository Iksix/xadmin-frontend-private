<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get/players/{id}', [\App\Http\Controllers\ServersController::class, 'getPlayers']);

Route::get('/get/bans', [\App\Http\Controllers\BansController::class, 'get']);
Route::get('/get/bans/name/{name}', [\App\Http\Controllers\BansController::class, 'getByName']);
Route::get('/get/bans/sid/{sid}', [\App\Http\Controllers\BansController::class, 'getBySid']);
Route::get('/get/bans/time/{time}', [\App\Http\Controllers\BansController::class, 'getByTime']);
Route::get('/get/bans/ip/{ip}', [\App\Http\Controllers\BansController::class, 'getByIp']);

Route::get('/get/admins', [\App\Http\Controllers\AdminsController::class, 'get']);

Route::get('/get/servers', [\App\Http\Controllers\ServersController::class, 'get'])->middleware('auth:sanctum');
Route::post('/add/server', [\App\Http\Controllers\ServersController::class, 'add'])->middleware('auth:sanctum');
Route::post('/delete/server', [\App\Http\Controllers\ServersController::class, 'delete'])->middleware('auth:sanctum');


Route::post('/unban', [\App\Http\Controllers\BansController::class, 'unban'])->middleware('auth:sanctum');

