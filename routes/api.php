<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TaskController;

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

Route::Resource('/Task',TaskController::class)->middleware('auth:sanctum');
Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');
Route::post('login',[UserController::class,'login']);

Route::post('register',[UserController::class,'register']);
