<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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
Route::post('/user/sign-up',[UserController::class,'signUp']);


Route::post('/user/login',[UserController::class,'login']);
Route::middleware('auth:sanctum')->post('/user/add-post',[PostController::class,'addPost']);
Route::middleware('auth:sanctum')->get('/user/getPost',[PostController::class,'GetMyPost']);
Route::middleware('auth:sanctum')->post('/user/Uppost',[PostController::class,'Uppost']);