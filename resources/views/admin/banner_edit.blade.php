@extends('admin.layouts.app')

@section('title', 'バナー管理')

@section('content')
    <div class="container-fluid px-3">
        {{-- 上部のナビ部分 --}}
        <div class="row mb-3">
            <div class="col-12 d-flex align-items-center fs-5 p-3">
                <a href="{{ route('admin.show.top') }}" class="text-dark fw-bold text-decoration-none">←戻る</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 mx-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="m-0">バナー管理</h2>
                </div>

                {{-- JSにURLを渡すための場所。ここだけはPHP(asset)を使ってOK --}}
                <div id="no-image-url" data-url="https://placehold.co/150x150?text=No+Image" class="d-none"></div>

                <form action="{{ route('admin.update.banner.edit') }}" method="POST" enctype="multipart/form-data" id="banner-form">
                    @csrf

                    <div id="banner-container">
                        {{-- 1. 既存のバナーを表示 --}}
                        @foreach($banners as $banner)
                        <div class="banner-row mb-3 d-flex align-items-center gap-3" data-id="{{ $banner->id }}">
                            {{-- 画像プレビュー --}}
                            <div class="banner-preview-wrapper">
                                <img src="{{ $banner->image_url }}" alt="バナー" class="img-fluid border preview-image">
                            </div>

                            {{-- ファイル名表示 ＆ インプット --}}
                            <div class="d-flex flex-column banner-input-width">
                                @if($banner->image)
                                    <small class="text-muted mb-1 text-truncate current-file-name" title="{{ basename($banner->image) }}">
                                        現在のファイル: <strong>{{ basename($banner->image) }}</strong>
                                    </small>
                                @endif
                                
                                <input type="hidden" name="banners[{{ $banner->id }}][id]" value="{{ $banner->id }}">
                                <input type="file" name="banners[{{ $banner->id }}][image]" class="form-control preview-input">
                            </div>

                            {{-- 削除ボタン --}}
                            <button type="button" class="btn btn-danger rounded-circle remove-banner btn-circle">－</button>
                        </div>
                        @endforeach
                    </div>

                    {{-- 2. 新規追加ボタン --}}
                    <div class="mt-4">
                        <button type="button" id="add-banner" class="btn btn-success rounded-circle btn-circle">＋</button>
                    </div>

                    <div id="deleted-ids-container"></div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-secondary px-5">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

{{-- 外部JSファイルを読み込む --}}
@push('scripts')
    <script src="{{ asset('js/admin/banner_edit.js') }}"></script>
@endpush