<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;  // 给 Auth 的 LoginController 起个别名

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;  // 给 Admin 的 LoginController 起个别名
use App\Http\Controllers\Admin\AdminController; // 导入 AdminController
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
// 首页
Route::get('/', [PostController::class, 'index'])->name('welcome');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
// 登录页面路由
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login']);

// 注销账号
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// 后台登录
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);



Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // 用户管理
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // 添加用户
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');

    // 评论管理
    Route::get('comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
     // 创建评论页面
     Route::get('comments/create', [AdminCommentController::class, 'create'])->name('admin.comments.create');
    
     // 存储评论
     Route::post('comments', [AdminCommentController::class, 'store'])->name('admin.comments.store');
     
     // 编辑评论页面
     Route::get('comments/{comment}/edit', [AdminCommentController::class, 'edit'])->name('admin.comments.edit');
     
     // 更新评论
     Route::put('comments/{comment}', [AdminCommentController::class, 'update'])->name('admin.comments.update');
     
     // 删除评论
     Route::delete('comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');

    // 显示所有文章的路由
    Route::get('posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    
    // 显示文章编辑表单的路由
    Route::get('posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    
    // 更新文章的路由
    Route::put('posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    
    Route::get('comments/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('comments/store', [AdminPostController::class, 'store'])->name('admin.posts.store');

    // 删除文章的路由
    Route::delete('posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');



    // 登出路由
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

});
