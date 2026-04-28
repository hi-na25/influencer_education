<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面 - @yield('title')</title>
    
    {{-- Bootstrapの読み込み --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/admin/common.css') }}">
</head>
<body class="bg-white ">
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

    {{-- Bootstrapの動き（JS）も念のため最後に入れておくと安心 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>