<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お知らせ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/admin_article.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin_article.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_article_list.css') }}">

</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}" class="back-link">←戻る</a>
        <h1>お知らせ一覧</h1>

        <a href="{{ route('admin.articles.create') }}" class="btn-new">新規登録</a>

        <table class="article-table">
            <thead>
        <tr>
            <th style="text-align: left; padding: 10px;">投稿日時</th>
            <th style="text-align: left; padding: 10px;">タイトル</th>
            <th></th> </tr>
        </thead>
            @foreach($articles as $article)
            <tr>
                <td style="width: 200px;">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年m月d日') }}</td>
                <td>{{ $article->title }}</td>
                <td style="width: 200px; text-align: right;">
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-edit">変更する</a>
                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">削除</button>
                   </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>