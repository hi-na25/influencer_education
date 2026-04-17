<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    // この「関数」を追加する
    public function showBannerEdit()
    {
        return view('admin.banner_edit'); 
    }
}