<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show($id)
    {
    // 指定されたIDのお知らせをDBから持ってくる
    $article = Article::findOrFail($id);
    
    // 画面（Blade）にデータを渡す
    return view('article', compact('article'));
    }
}