<?php
use App\Http\Controllers\User\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/progress', [App\Http\Controllers\User\ProgressController::class, 'index']);

Route::get('/news/{id}', [\App\Http\Controllers\User\ArticleController::class, 'show'])->name('news.show');

// パスワード変更画面の表示 (GET)
Route::get('/password/edit', [App\Http\Controllers\User\ProfileController::class, 'editPassword'])->name('password.edit');

// パスワード更新処理 (POST または PATCH)
Route::post('/password/update', [App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('password.update');


// 管理者用グループ（URLが /admin/... になります）
Route::prefix('admin')->name('admin.')->group(function () {
    
    // お知らせ編集画面の表示 (GET)
    Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    
    // お知らせ更新処理 (PUT)
    Route::put('/articles/{id}/update', [AdminArticleController::class, 'update'])->name('articles.update');

    Route::get('/articles', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('articles.index');

    Route::get('/articles/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('articles.create');

    // お知らせ削除処理
    Route::delete('/articles/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('articles.destroy');
});
