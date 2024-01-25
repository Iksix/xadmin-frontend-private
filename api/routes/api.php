<?php

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


Route::get('/login', \App\Http\Controllers\Auth\SteamAuthController::class);
Route::get('/get/bans', [\App\Http\Controllers\BansController::class, 'get']);
Route::get('/get/bans/name/{name}', [\App\Http\Controllers\BansController::class, 'getByName']);
Route::get('/get/bans/sid/{sid}', [\App\Http\Controllers\BansController::class, 'getBySid']);
Route::get('/get/bans/time/{time}', [\App\Http\Controllers\BansController::class, 'getByTime']);
Route::get('/get/bans/ip/{ip}', [\App\Http\Controllers\BansController::class, 'getByIp']);
