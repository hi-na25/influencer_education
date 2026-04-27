document.addEventListener('DOMContentLoaded', function () {
    // ページ全体のクリックを監視
    document.addEventListener('click', function (e) {
        // ajax-nav クラス、またはそれを含むリンクを探す
        const link = e.target.closest('.ajax-nav');
        if (!link || link.classList.contains('sidebar-btn--disabled')) return;

        e.preventDefault(); // ページリロードを阻止

        const date = link.dataset.date;
        const grade = link.dataset.grade;

        console.log("【Ajax送信】", { date, grade });

        // サーバーへリクエスト
        fetch(`/user/curriculum_list?date=${date}&grade=${grade}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            console.log("【データ受信】", data);

            // 1. カード一覧エリアを書き換え
            const listContainer = document.getElementById('curriculum-list');
            if (listContainer && data.html) {
                listContainer.innerHTML = data.html;
            }

            // 2. 年月タイトルを書き換え
            const titleElement = document.getElementById('calendar-title');
            if (titleElement && data.displayDate) {
                titleElement.textContent = data.displayDate + ' スケジュール';
            }

            // 3. 右上の「青い学年バッジ」を書き換え
            const gradeBadge = document.querySelector('.selected-grade-label');
            if (gradeBadge && data.gradeName) {
                gradeBadge.textContent = data.gradeName;
                // バッジの色も学年に合わせて変えたい場合はクラスを差し替える
                gradeBadge.className = `sidebar-btn py-1 px-3 selected-grade-label ${
                    data.selectedGrade <= 6 ? 'btn-elementary' : 
                    (data.selectedGrade <= 9 ? 'btn-junior-high' : 'btn-high-school')
                }`;
            }

            // 4. 全ボタン（◀▶と左メニュー）の data-date を現在の月に更新
            // これで「5月を見てる時に学年を変えても5月のまま」になります
            document.querySelectorAll('.ajax-nav').forEach(nav => {
                nav.dataset.date = data.currentMonth;
                // ◀▶ボタンだけは、次の「月移動」のために専用の月をセット
                if (nav.textContent.includes('◀')) nav.dataset.date = data.prevMonth;
                if (nav.textContent.includes('▶')) nav.dataset.date = data.nextMonth;
                
                // 現在の学年もセットし直す（月移動しても学年がズレないように）
                nav.dataset.grade = data.selectedGrade;
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('データの取得に失敗しました。');
        });
    });
});