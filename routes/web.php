<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

});


Route::middleware(['guest'])->group(function () {

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

