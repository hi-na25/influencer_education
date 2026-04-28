@extends('admin.layouts.app')

@section('title', 'トップページ')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- ★四角い枠（カードデザイン） --}}
            <div class="card shadow-sm border border-secondary-subtle">
                <div class="card-body p-5">
                    {{-- タイトル --}}
                    <h4 class="card-title text-center mb-5 font-weight-bold">
                        管理者情報
                    </h4>

                    {{-- ユーザーネーム --}}
                    <div class="row mb-4 fs-5">
                        <div class="col-md-4 text-muted">ユーザーネーム：</div>
                        <div class="col-md-8 font-weight-bold text-dark">
                            {{ $user->name ?? 'ゲスト' }}
                        </div>
                    </div>

                    {{-- メールアドレス --}}
                    <div class="row mb-4 fs-5">
                        <div class="col-md-4 text-muted">メールアドレス：</div>
                        <div class="col-md-8 text-secondary">
                            {{ $user->email ?? '未設定' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection