<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\user\TopController;

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



// 管理者バナー
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/banner_edit', [BannerController::class, 'showBannerEdit'])->name('show.banner.edit');
});



//　ユーザー時間割
Route::prefix('user')->namespace('User')->name('user.')->group(function () {
    Route::get('/curriculum_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum');
});



Route::prefix('user')->name('user.')->group(function () {
    Route::get('/top', [TopController::class, 'showTop'])->name('show.top');
});
