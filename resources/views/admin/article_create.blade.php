<link rel="stylesheet" href="{{ asset('css/article_create.css') }}">

<div class="container">
    {{-- 戻るボタンの遷移先は一覧画面（admin.articles.index）に設定しています --}}
    <a href="{{ route('admin.articles.index') }}" class="back-btn">戻る</a>
    
    <h2>お知らせ新規登録</h2>

    {{-- 実際に保存する処理（store）を作るまでは、actionは空のままで大丈夫です --}}
    <form action="{{ route('admin.articles.store') }}" method="POST">
        @csrf

        {{-- 投稿日時 --}}
        <div class="form-group">
            <label for="posted_date">投稿日時</label>
            <input type="datetime-local" id="posted_date" name="posted_date">
        </div>

        {{-- タイトル --}}
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" placeholder="タイトルを入力してください">
        </div>

        {{-- 本文 --}}
        <div class="form-group">
            <label for="article_contents">本文</label>
            <textarea id="article_contents" name="article_contents" rows="8" placeholder="本文を入力してください"></textarea>
        </div>

        {{-- 登録ボタン --}}
        <div class="button-container">
            <button type="submit" class="submit-btn">登録</button>
        </div>
    </form>
</div>

