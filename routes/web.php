<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\Admin\Auth\RegisterController; // ← これが必要です！
use App\Http\Controllers\Admin\Auth\LoginController;    // ついでにログイン用も！

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
    Route::get('/curriculum_list', 'CurriculumController@showCurriculumList')->name('show.curriculum');

    // 配信画面
    Route::get('/delivery/{id}', 'CurriculumController@showDelivery')->name('show.delivery');

    // トップページ
    Route::get('/top', 'TopController@showTop')->name('show.top');
});



// --- 管理画面側 ---
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {

    // ここに書いたルートは「ログインした管理者」しか見れない
    Route::group(['middleware' => ['auth:admin']], function () {

        // 管理者バナー
        Route::get('/banner_edit', 'BannerController@showBannerEdit')->name('show.banner.edit');

        // トップページ
        Route::get('/top', 'TopController@showTop')->name('show.top');

        // 授業一覧画面
        Route::get('/curriculum_list', 'CurriculumController@showCurriculumList')->name('show.curriculum.list');

        // お知らせ一覧画面
        Route::get('/article_list', 'ArticleController@showArticleList')->name('show.article.list');

        // ログアウト時
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    });


    // ログイン画面
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('show.login');

    // ログイン実行用（POST）
    Route::post('/login', 'Auth\LoginController@login')->name('login');

    // 管理ユーザー新規登録画面
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('show.register');

    // 管理ユーザー新規登録画面実行用
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
});
