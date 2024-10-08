<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
});

Route::group(['namespace' => 'Post'], function() {
    Route::get('/getAllPosts', [PostController::class, 'all'])->middleware('jwt.auth');
    Route::get('/getSinglePost', [PostController::class, 'single'])->middleware('jwt.auth');
    Route::post('/getSinglePost', [PostController::class, 'single'])->middleware('jwt.auth');
});