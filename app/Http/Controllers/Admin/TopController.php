<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TopController extends Controller
{
    public function showTop()
    {
        // 【テスト用】IDが1の管理者を強制的にログイン状態にする
        // 一度実行して名前が出たら、この一行は消してOKです
        \Illuminate\Support\Facades\Auth::guard('admin')->loginUsingId(1);

        $user = Auth::guard('admin')->user();

        return view('admin.top', compact('user'));
    }
}
