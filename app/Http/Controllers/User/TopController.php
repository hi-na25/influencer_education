<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function showTop()
    {
        // とりあえず文字列を出して動作確認
        return "ここはトップページです（制作中）";
        
        // 本来は以下のようにViewを返します
        // return view('user.top'); 
    }
}