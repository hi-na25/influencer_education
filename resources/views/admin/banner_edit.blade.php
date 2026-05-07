@extends('admin.layouts.app')

@section('title', 'バナー管理')

@section('content')
    <div class="container">
        {{-- 上部のナビ部分 --}}
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center fs-5">
                <a href="{{ route('admin.show.top') }}" class="text-dark fw-bold text-decoration-none">←戻る</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="m-0">バナー管理</h2>
                </div>

                <form action="{{ route('admin.update.banner.edit') }}" method="POST" enctype="multipart/form-data" id="banner-form">
                    @csrf

                    {{-- JS用のURL（コメントの中にキーワードを入れないようにしたよ） --}}
                    <div id="no-image-url" data-url="https://placehold.co/150x150?text=No+Image" style="display: none;"></div>

                    <div id="banner-container">
                        {{-- 1. 既存のバナーを表示 --}}
                        @foreach($banners as $banner)
                        <div class="banner-row mb-3 d-flex align-items-center gap-3" data-id="{{ $banner->id }}">
                            {{-- 画像プレビュー --}}
                            <div style="width: 150px;">
                                <img src="{{ $banner->image_url }}" alt="バナー" class="img-fluid border preview-image">
                            </div>

                            {{-- ファイル名表示 ＆ インプット --}}
                            <div class="d-flex flex-column" style="width: 300px;">
                                @if($banner->image)
                                    <small class="text-muted mb-1 text-truncate current-file-name" title="{{ basename($banner->image) }}">
                                        現在のファイル: <strong>{{ basename($banner->image) }}</strong>
                                    </small>
                                @endif
                                
                                <input type="hidden" name="banners[{{ $banner->id }}][id]" value="{{ $banner->id }}">
                                <input type="file" name="banners[{{ $banner->id }}][image]" class="form-control preview-input">
                            </div>

                            {{-- 削除ボタン --}}
                            <button type="button" class="btn btn-danger rounded-circle remove-banner" style="width: 40px; height: 40px;">－</button>
                        </div>
                        @endforeach
                    </div>

                    {{-- 2. 新規追加ボタン --}}
                    <div class="mt-4">
                        <button type="button" id="add-banner" class="btn btn-success rounded-circle" style="width: 40px; height: 40px;">＋</button>
                    </div>

                    <div id="deleted-ids-container"></div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-secondary px-5">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('banner-container');
            const addButton = document.getElementById('add-banner');
            const deletedContainer = document.getElementById('deleted-ids-container');
            const noImageUrl = document.getElementById('no-image-url').dataset.url;
            let newRowCount = 0;

            function setPreviewHandler(input, img, textElement) {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    
                    if (file) {
                        // ★【ここが追加ポイント】ファイル名をテキストに反映
                        if (textElement) {
                            textElement.innerHTML = `選択中: <strong>${file.name}</strong>`;
                            textElement.classList.replace('text-muted', 'text-primary'); // 色を変えると「変更中」って分かりやすい！
                        }

                        // 画像プレビューの処理（これはそのまま）
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();
                            reader.onload = function(re) { img.src = re.target.result; };
                            reader.readAsDataURL(file);
                        }
                    }
                });
            }

            // 既存の行にプレビュー設定
            container.querySelectorAll('.banner-row').forEach(row => {
                const input = row.querySelector('.preview-input');
                const img = row.querySelector('.preview-image');
                const text = row.querySelector('.current-file-name');
                
                // 引数に text も渡すことで、既存の行でも「選択中」が出るようになる
                setPreviewHandler(input, img, text);
            });

            // 追加ボタン
            addButton.addEventListener('click', function() {
                newRowCount++;
                const div = document.createElement('div');
                div.className = 'banner-row mb-3 d-flex align-items-center gap-3';
                
                // ★ HTMLに <small class="current-file-name"> を追加しておく
                div.innerHTML = `
                    <div style="width: 150px;"><img src="${noImageUrl}" class="img-fluid border preview-image"></div>
                    <div class="d-flex flex-column" style="width: 300px;">
                        <small class="text-muted mb-1 current-file-name">新規ファイルを選択してください</small>
                        <input type="file" name="banners[new_${newRowCount}][image]" class="form-control preview-input" required>
                    </div>
                    <button type="button" class="btn btn-danger rounded-circle remove-banner" style="width: 40px; height: 40px;">－</button>
                `;
                container.appendChild(div);

                // ★ ここでも textElement を渡す！
                const input = div.querySelector('.preview-input');
                const img = div.querySelector('.preview-image');
                const text = div.querySelector('.current-file-name');
                setPreviewHandler(input, img, text);
            });

            // 削除ボタン
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-banner')) {
                    const row = e.target.closest('.banner-row');
                    const id = row.dataset.id;
                    if (id) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'deleted_ids[]';
                        input.value = id;
                        deletedContainer.appendChild(input);
                    }
                    row.remove();
                }
            });
        });
    </script>
@endsection