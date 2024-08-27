<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\StudentRequestController;
use App\Models\StudentRequest;

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

Route::middleware(['auth'])->group(function () {
    //posts
    Route::middleware(['can:viewAny,App\Models\Post'])->get('', [PostController::class, 'index'])->name('posts.index');
    Route::middleware(['can:view,post'])->get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::middleware(['can:create,App\Models\Post'])->get('post/create', [PostController::class, 'create'])->name('posts.create');
    Route::middleware(['can:create,App\Models\Post'])->post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::middleware(['can:update,post'])->get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::middleware(['can:update,post'])->put('posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::middleware(['can:delete,post'])->delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::delete('posts/delete/{post}', [PostController::class, 'forceDelete'])->name('posts.force');
    Route::patch('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('post/trush', [PostController::class, 'trash'])->name('posts.trash');
    Route::get('/search', [PostController::class, 'search'])->name('post.search');
    Route::get('/sort/{category}', [PostController::class, 'sortBycategory'])->name('category.sort');

    //logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    
    //comments
    Route::middleware(['can:create,App\Models\Comment'])->get('comment/create', [CommentController::class, 'create'])->name('comments.create');
    Route::middleware(['can:create,App\Models\Comment'])->post('comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::middleware(['can:update,comment'])->get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::middleware(['can:update,comment'])->put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::middleware(['can:delete,comment'])->delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


    //category
    Route::middleware(['can:viewAny,App\Models\Category'])->get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::middleware(['can:view,category'])->get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::middleware(['can:create,App\Models\Category'])->get('category/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::middleware(['can:create,App\Models\Category'])->post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::middleware(['can:update,category'])->get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::middleware(['can:update,category'])->put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::middleware(['can:delete,category'])->delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

     //tag
    Route::middleware(['can:viewAny,App\Models\Tag'])->get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::middleware(['can:view,tag'])->get('tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    Route::middleware(['can:create,App\Models\Tag'])->get('tag/tag', [TagController::class, 'create'])->name('tags.create');
    Route::middleware(['can:create,App\Models\Tag'])->post('tags', [TagController::class, 'store'])->name('tags.store');
    Route::middleware(['can:update,tag'])->get('tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::middleware(['can:update,tag'])->put('tags/{tag}', [TagController::class, 'update'])->name('tags.update');

    Route::middleware(['can:delete,tag'])->delete('tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    //Requests

    Route::get('request', [StudentRequestController::class, 'index'])->name('requests.index');
    Route::get('request/create', [StudentRequestController::class, 'create'])->name('requests.create');
    Route::post('requests', [StudentRequestController::class, 'store'])->name('requests.store');
    Route::put('request/{studentRequest}',[StudentRequestController::class, 'approve'])->name('requests.approve');
    Route::delete('requests/{studentRequest}', [StudentRequestController::class, 'destroy'])->name('requests.destroy');
    //Projects
    Route::middleware(['can:view,project'])->get('project/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::middleware(['can:viewAny,App\Model\Project'])->get('projects',[ProjectController::class, 'index'])->name('projects.index');
    Route::middleware(['can:create,App\Models\Project'])->get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::middleware(['can:create,App\Models\Project'])->post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::middleware(['can:delete,project'])->delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::middleware(['can:update,project'])->get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::middleware(['can:update,project'])->put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
     //users
    Route::get('user', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('user/create', [UserController::class, 'create'])->name('users.create');
    Route::get('user/trush', [UserController::class, 'trash'])->name('users.trash');
    Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    Route::patch('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    //reaction

    Route::post('/posts/{post}/react', [ReactionController::class, 'react'])->name('posts.react');

});


Route::middleware(['guest'])->group(function () {
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});




Route::get('/home', [HomeController::class, 'index'])->name('home');
