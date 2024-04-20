<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| このファイルでは、アプリケーションのウェブルートを登録します。
| これらのルートは RouteServiceProvider によって読み込まれ、"web" ミドルウェア
| グループに割り当てられます。素晴らしいものを作りましょう！
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PostController のルート
Route::controller(PostController::class)->middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index')->middleware('auth');
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/create', [PostController::class, 'create'])->name('create');
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::get('/main_posts/{post}', [PostController::class, 'main_show']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('/posts/{post}/likes', [PostController::class, 'getLikesForPost']);
    Route::post('/posts/{post}/likes', [PostController::class, 'like']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'delete']);
    Route::middleware('auth')->get('/my-posts', [PostController::class, 'myPosts'])->name('my-posts');
    Route::get('/my_categories/{category}', [CategoryController::class, 'my_posts']);
});

// CategoryController のルート
Route::get('/categories/{category}', [CategoryController::class, 'index']);

// ProfileController のルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

