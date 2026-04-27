document.addEventListener('DOMContentLoaded', function () {
    console.log("JS読み込み完了！");

    document.addEventListener('click', function (e) {
        // ajax-nav を持っているか、その子要素（◀など）をクリックしたか判定
        const link = e.target.closest('.ajax-nav');
        
        // ボタンがない、または無効化されていたら終了
        if (!link || link.classList.contains('sidebar-btn--disabled')) return;

        e.preventDefault();

        const date = link.dataset.date;
        const grade = link.dataset.grade;

        console.log("【Ajax送信】", { date, grade });

        fetch(`/user/curriculum_list?date=${date}&grade=${grade}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            console.log("【データ受信】", data);

            // 1. カード一覧を書き換え
            const listContainer = document.getElementById('curriculum-list');
            if (listContainer) listContainer.innerHTML = data.html;

            // 2. 年月タイトルを書き換え
            const titleElement = document.getElementById('calendar-title');
            if (titleElement) titleElement.textContent = data.displayDate + ' スケジュール';

            // 3. 右上のバッジを書き換え
            const gradeBadge = document.querySelector('.selected-grade-label');
            if (gradeBadge) {
                gradeBadge.textContent = data.gradeName;
                gradeBadge.className = `sidebar-btn py-1 px-3 selected-grade-label ${
                    data.selectedGrade <= 6 ? 'btn-elementary' : 
                    (data.selectedGrade <= 9 ? 'btn-junior-high' : 'btn-high-school')
                }`;
            }

            // --- 4. 全ボタンの状態を同期する ---
            document.querySelectorAll('.ajax-nav').forEach(nav => {
                // 【重要】◀▶ボタン（前後月移動）だけに、今選んだ学年をセットする
                // 左メニューのボタンは、自分の grade を維持させたいのでここでは上書きしない！
                if (nav.classList.contains('calendar-nav__link')) {
                    nav.dataset.grade = data.selectedGrade; // カレンダー移動用に学年を同期
                    
                    if (nav.innerText.includes('◀')) {
                        nav.dataset.date = data.prevMonth;
                    } else {
                        nav.dataset.date = data.nextMonth;
                    }
                } else {
                    // 左メニューの学年ボタンの場合
                    // 学年(grade)はそのまま、表示月(date)だけを最新状態に合わせる
                    nav.dataset.date = data.currentMonth;
                }
            });
            console.log("【全ボタン更新完了】");
        })
        .catch(error => console.error('Error:', error));
    });
});