<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);

Route::middleware('auth:api','member')->prefix('user')->group(function(){

    Route::get('/tasks',[UserController::class,'index']);
    Route::post('/tasks/store',[UserController::class,'store']);
    Route::delete('/tasks/delete/{task}',[UserController::class,'destroy']);
});

Route::middleware('auth:api','can:isAdmin')->prefix('admin')->group(function(){

    Route::get('/tasks',[AdminController::class,'tasks']);
    Route::get('/users',[AdminController::class,'users']);
    Route::post('/tasks/store',[AdminController::class,'store']);
    Route::post('/tasks/update/{task}',[AdminController::class,'update']);
    Route::post('/tasks/add-user/{task}',[AdminController::class,'addUser']);
    Route::delete('/tasks/delete/{task}',[AdminController::class,'destroy']);
});


