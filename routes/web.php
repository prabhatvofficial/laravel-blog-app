<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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

Route::get('admins-only', function(){
    return "onl;yn admin";
})->middleware('can:visitAdminPages');

Route::get('/', [UserController::class, "showCorrectHomepage"])->name('login');
Route::post('/register', [UserController::class, "register"])->middleware('guest');
Route::post('/login', [UserController::class, "login"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware('auth');

Route::get('/create-post', [PostController::class, "showCreateForm"])->middleware('auth');
Route::post('/create-post', [PostController::class, "storeNewPost"])->middleware('auth');
Route::get('/post/{post}', [PostController::class, "showSinglePost"]);
Route::get('/post/{post}/edit', [PostController::class, "showUpdateForm"])->middleware('can:delete,post');
Route::put('/post/{post}/edit', [PostController::class, "actuallyUpdate"])->middleware('can:delete,post');
Route::get('/search/{term}', [PostController::class, "search"]);

Route::get('/profile/{user:username}', [UserController::class, "profile"]);
Route::get('/profile/{user:username}/followers', [UserController::class, "profileFollowers"]);
Route::get('/profile/{user:username}/following', [UserController::class, "profileFollowing"]);
Route::get('/manage-avatar', [UserController::class, "showAvatarForm"])->middleware('auth');
Route::post('/manage-avatar', [UserController::class, "storeAvatar"])->middleware('auth');

//follow

Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('auth');
Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('auth');
