<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面 - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin/common.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">授業管理</a></li>
                <li><a href="#">お知らせ管理</a></li>
                <li><a href="#">バナー管理</a></li>
                <li><a href="#">ログアウト</a></li>
            </ul>
        </nav>
    </header>

    <main>
        {{-- ここに各画面（子）の中身が差し込まれる！ --}}
        @yield('content')
    </main>

    <footer>
        
    </footer>
</body>
</html>