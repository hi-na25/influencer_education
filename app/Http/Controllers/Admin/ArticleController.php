<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Http\Controllers\User\Controller;

class ArticleController extends Controller
{
    // 編集画面を表示するメソッド
    public function edit($id)
    {
        // 編集したいお知らせを1件取得
        $article = Article::findOrFail($id);
        
        // adminフォルダの中のedit.blade.phpを返す
        return view('admin.article_edit', compact('article'));
    }

    public function update(ArticleRequest $request, $id)
    {

        // 2. 更新するデータを取得
        $article = Article::findOrFail($id);

        // 3. データを上書きして保存
        $article->update([
            'title' => $request->title,
            'posted_date' => $request->posted_date,
            'article_contents' => $request->article_contents,
        ]);

        // 4. 一覧画面などにリダイレクト（成功メッセージ付き）
        return redirect()->route('admin.articles.index')->with('success', 'お知らせを更新しました！');
    }

    public function index()
    {
        // DBからお知らせをすべて取得（投稿日時の新しい順）
        $articles = Article::orderBy('posted_date', 'desc')->get();

        // resources/views/admin/article_list.blade.php を表示
        return view('admin.article_list', compact('articles'));
    }

    public function destroy($id)
    {
        // 指定されたIDのお知らせを探して削除
        $article = Article::findOrFail($id);
        $article->delete();

        // 一覧画面にリダイレクト
        return redirect()->route('admin.articles.index');
    }

}
