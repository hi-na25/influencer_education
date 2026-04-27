document.addEventListener('DOMContentLoaded', function () {
    console.log("JS読み込み完了！"); // これが出るか確認
    
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

            // 4. 次のクリックのために各ボタンのデータを更新する
            // ここで「左メニューのボタン」と「◀▶ボタン」の両方を更新します
            document.querySelectorAll('.ajax-nav').forEach(nav => {
                // 全ボタンの基準学年を「今選んだ学年」に合わせる
                nav.dataset.grade = data.selectedGrade;
                
                // ◀▶ボタンは「前月」「次月」をセット
                if (nav.textContent.includes('◀')) {
                    nav.dataset.date = data.prevMonth;
                } else if (nav.textContent.includes('▶')) {
                    nav.dataset.date = data.nextMonth;
                } else {
                    // 学年ボタン（左メニュー）は「今表示している月」を維持
                    nav.dataset.date = data.currentMonth;
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('データの取得に失敗しました。');
        });
    });
});