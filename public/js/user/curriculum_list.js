document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        // ajax-nav または sidebar-btn を探す
        const link = e.target.closest('.ajax-nav') || e.target.closest('.sidebar-btn');
        
        // ボタンがない、または無効化されている場合は無視
        if (!link || link.classList.contains('sidebar-btn--disabled')) return;

        // data-date がない要素（戻るボタンなど）は Ajax 対象外にする
        const date = link.dataset.date;
        if (!date) return; 

        e.preventDefault();

        // grade は link になければ、他のナビリンクから現在の値を探して補完する
        let grade = link.dataset.grade;
        if (!grade) {
            const anyNav = document.querySelector('.ajax-nav[data-grade]');
            grade = anyNav ? anyNav.dataset.grade : '';
        }

        console.log("通信開始:", { date, grade });

        fetch('/user/curriculum_list?date=' + date + '&grade=' + grade, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            console.log("受信データ:", data);

            // 1. メインコンテンツ更新
            const listContainer = document.getElementById('curriculum-list');
            if (listContainer) listContainer.innerHTML = data.html;

            // 2. タイトル更新
            const titleElement = document.getElementById('calendar-title');
            if (titleElement) titleElement.textContent = data.displayDate + ' スケジュール';

            // 3. ナビゲーション（◀▶）更新
            document.querySelectorAll('.ajax-nav').forEach(nav => {
                nav.dataset.date = nav.textContent.includes('◀') ? data.prevMonth : data.nextMonth;
                nav.dataset.grade = data.selectedGrade; // 現在の学年をセット
            });

            // 4. 学年バッジ更新
            const gradeBadge = document.querySelector('.selected-grade-label');
            if (gradeBadge) gradeBadge.textContent = data.gradeName;

            // 5. 左メニュー（学年ボタン）更新
            document.querySelectorAll('.sidebar-btn[data-grade]').forEach(btn => {
                btn.dataset.date = data.currentMonth; // 現在表示中の月をセット
            });
        })
        .catch(error => console.error('Error:', error));
    });
});