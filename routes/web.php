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
Route::prefix('user')->name('user.')->group(function () {

    //　ユーザー時間割
    Route::get('/curriculum_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum');


    // 配信画面 (指示書：パスは '/delivery/{id}', nameは 'show.delivery')
    // フルネームは 'user.show.delivery'
    Route::get('/delivery/{id}', [CurriculumController::class, 'showDelivery'])->name('show.delivery');


    // トップページ
    Route::get('/top', [TopController::class, 'showTop'])->name('show.top');


});



// --- 管理画面側 ---
Route::prefix('admin')->name('admin.')->group(function () {
    

    // 管理者バナー
    Route::get('/banner_edit', [BannerController::class, 'showBannerEdit'])->name('show.banner.edit');



});

