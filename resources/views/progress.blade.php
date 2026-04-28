<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>授業進捗</title>
    <style>
        .container { max-width: 1000px; margin: 0 auto; padding: 20px; font-family: sans-serif; }
        .profile-section { display: flex; align-items: center; margin-top: 30px; }
        .avatar { width: 150px; height: 150px; border: 1px solid #ccc; margin-right: 20px; background-color: #f9f9f9; }
        .grade-badge { display: inline-block; background-color: #B2EBF2; color: #00838F; padding: 5px 15px; border-radius: 20px; margin-top: 10px; }
        
        /* グリッドの設定 */
        .progress-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 20px;
        }
        .grade-card h2 {
            font-size: 16px;
            color: #00838F;
            display: inline-block;
            padding: 3px 15px;
            border-radius: 15px;
        }
        .grade-card ul { list-style: none; padding: 0; }
        .grade-card li { margin-bottom: 8px; font-size: 14px; }
        .status-done { color: #FF5252; font-weight: bold; margin-right: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" style="text-decoration: none; color: #333;">←戻る</a>
        <div class="profile-section">
            <div class="avatar">
                <img src="images/profile.png" alt="avatar" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div class="user-info">
                <h1>{{ $userName }}さんの授業進捗</h1>
                <div>現在の学年：<span class="grade-badge">{{ $currentGrade }}</span></div>
            </div>
        </div>

        <hr style="margin: 40px 0; border: none; border-top: 1px solid #eee;">

        <div class="progress-grid">
            @foreach($grades as $grade)
                <div class="grade-card">
                    <h2 style="background-color: {{ $grade['color'] }};">{{ $grade['name'] }}</h2>
                    <ul>
                        @foreach($curriculums as $curriculum)
                            {{-- 今表示している「学年」のデータだけを表示する --}}
                            @if($curriculum->grade_id == $loop->parent->index + 1)
                                <li>
                                    <div style="display: flex; align-items: center;">
                                        {{-- 受講済エリアの幅を 60px に固定して確保 --}}
                                        <div style="width: 50px; flex-shrink: 0;">
                                            @if($curriculum->alway_delivery_flg == 1)
                                                <span style="color: red; font-weight: bold; font-size: 0.8rem;">受講済</span>
                                            @endif
                                        </div>
    
                                       {{-- タイトルをリンクにする --}}
                                       <a href="/delivery/{{ $curriculum->id }}" style="text-decoration: none; color: #333;">
                                           {{ $curriculum->title }}
                                       </a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>