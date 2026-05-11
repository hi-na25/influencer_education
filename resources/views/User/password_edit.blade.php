<head>
    <link rel="stylesheet" href="{{ asset('css/user_password.css') }}">
</head>

<div class="password-edit-container">
    <a href="#" class="back-link">←戻る</a>
    <h1>パスワード変更</h1>

    @if (session('status'))
        <p style="color: green; font-weight: bold;">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>旧パスワード</label>
            <input type="password" name="current_password">
        </div>

        <div class="form-group">
            <label>新パスワード</label>
            <input type="password" name="new_password">
        </div>

        <div class="form-group">
            <label>新パスワード確認</label>
            <input type="password" name="new_password_confirmation">
        </div>

        <button type="submit" class="btn-submit">登録</button>
    </form>
</div>