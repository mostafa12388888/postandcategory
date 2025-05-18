<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\AdminController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\frontend\dashboard\ProfileController;
use App\Http\Controllers\frontend\dashboard\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewSubscriberController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//////////////////////
//////////////////////
Route::middleware('auth:sanctum')->group(function () {
 //there is the permission
 Route::resource('roles', RoleController::class);

 Route::resource('users', UserController::class);
});
//////////////////////
//////////////////////
//////////////////////
//////////////////////
Route::redirect('/', '/home');
// front end
Route::group(['as' => 'frontend.'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('index');
        // ->middleware(['auth','verified']);
    });

    Route::get('category/{slug}', CategoryController::class)->name('category.posts');
    Route::prefix('post')->controller(PostController::class)->group(function () {
        Route::get('/{slug}', 'show')->name('post.show');
        Route::get('/comment/{slug}', 'getAllComments')->name('comment.show');
        Route::post('/comment', 'store')->name('comment.store');
    });
    Route::match(['get', 'post'], '/search', SearchController::class)->name('search');
    Route::prefix('account')->name('dashboard.')->middleware('auth:sanctum')->group(function () {
        // manage Profile page
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('profile');
            Route::post('post/store', 'storePost')->name('post.store');
            Route::get('post/edit/{slug}', 'editPost')->name('post.edit');
            Route::put('post/edit/{id}', 'updatePost')->name('post.update');
            Route::delete('post/delete', 'deletePost')->name('post.delete');
            Route::get('post/get-comments/{id}', 'getComments')->name('post.comments');
            Route::post('post/image/delete', 'deletePostImage')->name('post.image.delete');
        });
        Route::controller(SettingController::class)->group(function () {
            Route::get('setting', 'getSetting')->name('setting');
            Route::post('setting/update', 'update')->name('setting.update');
        });
        //there is the permission
        Route::resource('roles', RoleController::class);

        Route::resource('users', UserController::class);
    });

    Route::prefix('/admin')->controller(AdminController::class)->name('admin.')->group(function () {
        Route::get('/show-post', 'index')->name('post');
        Route::delete('/post', 'deletePost')->name('post.delete');
    });
});



// Route::prefix('email')->controller(VerificationController::class)->name('verification.')->group(function () {
//     Route::get('/verify', 'show')->name('notice');
//     Route::get('/verify/{id}/{hash}', 'verify')->name('verify');
//     Route::post('/resend', 'resend')->name('resend');
// });
//////////////////////
//////////////////////
//////////////////////
//////////////////////
//////////////////////
//////////////////////
