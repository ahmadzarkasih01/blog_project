<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('register', [AuthController::class, 'register_form']);
Route::post('register', [AuthController::class, 'register']);

Route::post('posts',[PostController::class, 'store']);
Route::get('posts',[PostController::class, 'index']);
Route::get('posts/create',[PostController::class, 'create']);
Route::get('posts/{id}',[PostController::class, 'show']);
Route::get('posts/{id}/edit',[PostController::class, 'edit']);
Route::patch('posts/{id}',[PostController::class, 'update']);
Route::delete('posts/{id}',[PostController::class, 'destroy']);

