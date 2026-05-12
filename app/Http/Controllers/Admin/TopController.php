<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class TopController extends Controller
{
    public function showTop()
    {
        $user = Auth::guard('admin')->user();

        return view('admin.top', compact('user'));
    }
}
