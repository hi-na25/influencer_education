        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('banner-container');
            const addButton = document.getElementById('add-banner');
            const deletedContainer = document.getElementById('deleted-ids-container');
            const noImageUrl = document.getElementById('no-image-url').dataset.url;
            let newRowCount = 0;

            function setPreviewHandler(input, img, textElement) {
                if (!input || !img) return;
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    
                    if (file) {
                        // ファイル名をテキストに反映
                        if (textElement) {
                            textElement.innerHTML = `選択中: <strong>${file.name}</strong>`;
                            textElement.classList.replace('text-muted', 'text-primary'); // 色を変えると「変更中」って分かりやすい！
                        }

                        // 画像プレビューの処理
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
                
                // HTMLに <small class="current-file-name"> を追加しておく
                div.innerHTML = `
                    <div class="banner-preview-wrapper">
                        <img src="${noImageUrl}" class="img-fluid border preview-image">
                    </div>
                    <div class="d-flex flex-column banner-input-width">
                        <small class="text-muted mb-1 current-file-name">新規ファイルを選択してください</small>
                        <input type="file" name="banners[new_${newRowCount}][image]" class="form-control preview-input">
                    </div>
                    <button type="button" class="btn btn-danger rounded-circle remove-banner btn-circle">－</button>
                `;
                container.appendChild(div);

                // ここでも textElement を渡す
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
