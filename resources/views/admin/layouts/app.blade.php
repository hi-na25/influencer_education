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
                <li><a href="{{ route('admin.show.curriculum.list') }}">授業管理</a></li>
                <li><a href="{{ route('admin.show.article.list') }}">お知らせ管理</a></li>
                <li><a href="{{ route('admin.show.banner.edit') }}">バナー管理</a></li>
                <li><a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </nav>
    </header>

    <main>
        {{-- ここに各画面（子）の中身が差し込まれる --}}
        @yield('content')
    </main>

    {{-- 1. 共通ライブラリを読み込む --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- 2. その後に、各画面ごとのJSを流し込む --}}
    @stack('scripts')
</body>
</html>