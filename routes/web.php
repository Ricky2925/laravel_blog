<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;  // Aliased LoginController for user authentication

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;  // Aliased LoginController for admin authentication
use App\Http\Controllers\Admin\AdminController; // Admin dashboard controller
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;  

use App\Http\Controllers\Admin\PostController as AdminPostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home page
Route::get('/', [PostController::class, 'index'])->name('welcome');
// Show individual post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Store a new comment
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
// Registration page
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// Delete a comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
// Login page route
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login']);

// Logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin login
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);


// Admin routes group
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    // Admin dashboard
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // User management
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Create new user
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');

    // Comment management
    Route::get('comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
     // Create comment page
     Route::get('comments/create', [AdminCommentController::class, 'create'])->name('admin.comments.create');
    
     // Store comment
     Route::post('comments', [AdminCommentController::class, 'store'])->name('admin.comments.store');
     
     // Edit comment page
     Route::get('comments/{comment}/edit', [AdminCommentController::class, 'edit'])->name('admin.comments.edit');
     
     // Update comment
     Route::put('comments/{comment}', [AdminCommentController::class, 'update'])->name('admin.comments.update');
     
     // Delete comment
     Route::delete('comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');

    // Display all posts
    Route::get('posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    
    // Edit post form
    Route::get('posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    
    // Update post
    Route::put('posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    // Create new post form
    Route::get('comments/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('comments/store', [AdminPostController::class, 'store'])->name('admin.posts.store');

    // Delete post
    Route::delete('posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');



    // Admin logout route
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

});
