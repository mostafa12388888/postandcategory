<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
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

use App\Http\Controllers\API\Auth\LoginController;

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//postController
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(PostController::class)->prefix('post')->group(function () {
        Route::get('/index', 'index');
        Route::get('/user-posts', 'userPosts');
        Route::get('/post-comments/{id}', 'postComments');
        Route::post('/add', 'addPost');
        Route::post('/edit/{id}', 'editPost');
        Route::delete('/delete/{id}', 'deletePost');
    });
    Route::get('categories', [CategoryController::class, 'index'])->name('category');
});
