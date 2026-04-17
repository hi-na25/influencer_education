<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー画面 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/common.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">時間割</a></li>
                <li><a href="#">授業進捗</a></li>
                <li><a href="#">プロフィール設定</a></li>
                <li><a href="#">ログアウト</a></li>
            </ul>
        </nav>
    </header>

    <main>
        {{-- ここに各画面（子）の中身が差し込まれる！ --}}
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 チーム開発研修</p>
    </footer>
</body>
</html>