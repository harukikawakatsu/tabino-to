<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;  //外部にあるPostControllerクラスをインポート。
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [PostController::class, 'index']);
Route::get('/', [PostController::class, 'index'])->name('index')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [PostController::class, 'index']);   

Route::get('/posts/create', [PostController::class, 'create'])->name('create');
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
Route::get('/posts/{post}/likes', [PostController::class, 'getLikesForPost']);
Route::get('/posts/{post}', [PostController::class ,'show']);
Route::get('/main_posts/{post}', [PostController::class ,'main_show']);
// '/posts/{対象データのID}'にGetリクエストが来たら、PostControllerのshowメソッドを実行する
// '/posts/{対象データのID}'にGetリクエストが来たら、PostControllerのshowメソッドを実行する
Route::post('/posts', [PostController::class, 'store']);
Route::post('/posts/{post}/likes', [PostController::class, 'like']);
// postメソッドの時は、postの時にそのURLを受け取ってルートが処理する
Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class,'delete']);
Route::get('/categories/{category}', [CategoryController::class,'index']);
Route::middleware('auth')->get('/my-posts', [PostController::class, 'myPosts'])->name('my-posts');
Route::get('/my_categories/{category}', [CategoryController::class,'my_posts']);
require __DIR__.'/auth.php';


