<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TopController extends Controller
{
    public function showTop()
    {
        // ログイン中の管理者情報を取得（もし画面で名前などを出したい場合）
        $user = Auth::user();

        // resources/views/admin/top.blade.php を表示する
        return view('admin.top', compact('user'));
    }
}
