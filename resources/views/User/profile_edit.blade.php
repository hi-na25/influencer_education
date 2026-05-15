<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール変更</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <a href="javascript:history.back()" class="back-link">←戻る</a>
    <h1>プロフィール変更</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="profile-section">
            <div class="image-preview-container">
                {{-- Auth::user() を使わず、コントローラーから渡した $user を使う --}}
                <img id="preview" src="{{ ($user && $user->profile_image) ? asset('storage/' . $user->profile_image) . '?' . time() : asset('images/default-user.png') }}">
            </div>
            <div>
                <label class="image-upload-label">プロフィール画像</label>
                <input type="file" name="profile_image" id="image_input" accept="image/*">
            </div>
        </div>

        <div class="input-group">
            <div class="input-row">
                <label>ユーザーネーム</label>
                <input type="text" name="name" value="{{ $user->name ?? '' }}">
            </div>
            <div class="input-row">
                <label>カナ</label>
                <input type="text" name="name_kana" value="{{ $user->name_kana ?? '' }}">
            </div>
            <div class="input-row">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ $user->email ?? '' }}">
            </div>
            <div class="input-row">
                <label>パスワード</label>
                <a href="{{ route('password.edit') }}" class="pass-btn">パスワードを変更する</a>
            </div>
        </div>

        <button type="submit" class="submit-btn">登録</button>
    </form>

    <script>
        document.getElementById('image_input').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
</body></html>