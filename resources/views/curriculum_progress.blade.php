<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>授業進捗</title>
    {{-- ✅ 外部CSSファイルを読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/curriculum_progress.css') }}">
</head>
<body>
    <div class="container">
        <a href="/" style="text-decoration: none; color: #333;">←戻る</a>
        <div class="profile-section">
            <div class="avatar">
                <img src="{{ asset('storage/images/profile/profile.png') }}" alt="avatar" style="width: 100%; height: 100%; object-fit: cover;">
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
                    <h2 style="background-color: {{ $grade->color }};">{{ $grade->name }}</h2>
                    <ul>
                        @foreach($curriculums as $curriculum)
                            {{-- 今表示している「学年」のデータだけを表示する --}}
                            @if($curriculum->grade_id == $loop->parent->index + 1)
                                <li>
                                    <div style="display: flex; align-items: center;">
                                        {{-- 受講済エリアの幅を 60px に固定して確保 --}}
                                        <div style="width: 50px; flex-shrink: 0;">
                                            @if(in_array($curriculum->id, $clearedCurriculumIds))
                                               <span style="color: #ff4d4d; font-weight: bold;">受講済</span>
                                            @endif
                                        </div>
    
                                       {{-- タイトルをリンクにする --}}
                                       @if($grade->id <= $user->grade_id)
                                           {{-- 自分の学年以下ならクリックできる --}}
                                           <a href="/delivery/{{ $curriculum->id }}" style="text-decoration: none; color: #333;">
                                               {{ $curriculum->title }}
                                           </a>
                                       @else
                                           {{-- 自分の学年より上ならクリックできない（色を薄くする） --}}
                                           <span style="color: #bbb; cursor: not-allowed;">
                                               {{ $curriculum->title }}
                                           </span>
                                       @endif
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