<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;


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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/



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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware(['guest'])->group(function () {
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);});


Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/logout', [AuthController::class, 'logout']);
//Posts
Route::middleware(['can:viewAny,App\Models\Post'])->get('/posts', [PostController::class, 'index']);
Route::middleware(['can:view,post'])->get('/posts/{post}', [PostController::class, 'show']);
Route::middleware(['can:create,App\Models\Post'])->post('/posts', [PostController::class, 'store']);
Route::middleware(['can:update,post'])->put('/posts/{post}', [PostController::class, 'update']);
Route::middleware(['can:delete,post'])->delete('/posts/{post}', [PostController::class, 'destroy']);

//Comments
Route::middleware(['can:viewAny,App\Models\Comment'])->get('/comments', [CommentController::class, 'index']);
Route::middleware(['can:view,comment'])->get('/comments/{comment}', [CommentController::class, 'show']);
Route::middleware(['can:create,App\Models\Comment'])->post('/comments', [CommentController::class, 'store']);
Route::middleware(['can:update,comment'])->put('/comments/{comment}', [CommentController::class, 'update']);
Route::middleware(['can:delete,comment'])->delete('/comments/{comment}', [CommentController::class, 'destroy']);

//Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

//Tags
Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{tag}', [TagController::class, 'show']);
});

<<<<<<< HEAD
?>
=======
?>
>>>>>>> 5ca0266a9a15a95057f6f6749df01449320d15c9
