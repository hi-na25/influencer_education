<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\User\TopController;

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


// --- ユーザー側 ---
Route::prefix('user')->namespace('User')->name('user.')->group(function () {

    // ユーザー時間割
    Route::get('/curriculum_list', [\App\Http\Controllers\User\CurriculumController::class, 'showCurriculumList'])->name('show.curriculum');

    // 配信画面
    Route::get('/delivery/{id}', [\App\Http\Controllers\User\CurriculumController::class, 'showDelivery'])->name('show.delivery');

    // トップページ
    Route::get('/top', [\App\Http\Controllers\User\TopController::class, 'showTop'])->name('show.top');
});



// --- 管理画面側 ---
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {


    // 管理者バナー
    Route::get('/banner_edit', [\App\Http\Controllers\Admin\BannerController::class, 'showBannerEdit'])->name('show.banner.edit');

    // トップページ
    Route::get('/top', [\App\Http\Controllers\Admin\TopController::class, 'showTop'])->name('show.top');

    // 授業一覧画面
    Route::get('/curriculum_list', [\App\Http\Controllers\Admin\CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');

    // お知らせ一覧画面
    Route::get('/article_list', [\App\Http\Controllers\Admin\ArticleController::class, 'showArticleList'])->name('show.article.list');

    // ログイン画面
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('show.login');

    // 管理ユーザー新規登録画面
    Route::get('/register', [\App\Http\Controllers\Admin\RegisterController::class, 'showRegisterForm'])->name('show.register');
});
