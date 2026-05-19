<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お知らせ変更</title>

    <link rel="stylesheet" href="{{ asset('css/admin_article.css') }}">
</head>
<body>

<div class="container">
    <a href="{{ route('admin.articles.index') }}" class="back-link">←戻る</a>
    <h1>お知らせ変更</h1>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>投稿日時</label>
            <input type="datetime-local" name="posted_date" 
                   value="{{ old('posted_date', date('Y-m-d\TH:i', strtotime($article->posted_date))) }}">
            @error('posted_date')
                <span style="color: red; font-size: 14px; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>タイトル</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}">
            @error('title')
                <span style="color: red; font-size: 14px; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>本文</label>
            <textarea name="article_contents">{{ old('article_contents', $article->article_contents) }}</textarea>
            @error('article_contents')
                <span style="color: red; font-size: 14px; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="submit-btn">登録</button>
    </form>
</div>

</body>
</html>