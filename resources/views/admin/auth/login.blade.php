<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理画面ログイン</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="text-end mt-5">
                    <a href="{{ route('admin.show.register') }}" class="text-decoration-none link-dark">新規会員登録はこちら</a>
                </div>

                <div class="card-header text-center">
                        <h4>{{ __('管理画面ログイン') }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.show.login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('メールアドレス') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('パスワード') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-secondary btn-lg">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>