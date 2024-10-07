<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/getAllPosts', [PostController::class, 'all']);
Route::get('/getSinglePost', [PostController::class, 'single']);
