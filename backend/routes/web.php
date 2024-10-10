<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Post'], function() {
    Route::get('/getAllPosts', [PostController::class, 'all']);
    Route::get('/getSinglePost', [PostController::class, 'single']);
    Route::post('/createPost', [PostController::class, 'create']);
});