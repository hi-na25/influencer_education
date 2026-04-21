<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>授業配信確認（仮）</title>
</head>
<body>
    <h1>【動作確認用】授業配信ページ</h1>
    <p><a href="{{ route('user.show.curriculum') }}">← 一覧に戻る</a></p>

    <hr>

    <h3>取得できたデータ：</h3>
    <ul>
        <li><strong>授業ID:</strong> {{ $curriculum->id }}</li>
        <li><strong>タイトル:</strong> {{ $curriculum->title }}</li>
        <li><strong>サムネイルパス:</strong> {{ $curriculum->thumbnail }}</li>
        <li><strong>説明文:</strong> {{ $curriculum->description }}</li>
    </ul>

    <div style="margin-top: 20px; padding: 20px; border: 1px dashed #ccc;">
        <p>※ここには本来動画プレイヤーなどが入ります（他担当者用メモ）</p>
    </div>
</body>
</html>