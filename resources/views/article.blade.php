{{-- 規約に沿って外部CSSを読み込み --}}
<link rel="stylesheet" href="{{ asset('css/article.css') }}">

<main class="news-main">
    <div class="news-container">
        {{-- 戻るボタンは container の左端に配置される --}}
        <a href="/" class="news-back-link">←戻る</a>

        {{-- この news-content で囲むことで、中身だけをさらに中央に寄せます --}}
        <article class="news-content">
            <header class="news-content__header">
                <p class="news-content__date">{{ $article->created_at->format('Y年m月d日') }}</p>
                <h1 class="news-content__title">{{ $article->title }}</h1>

                <div class="news-content__body">
                    <p>{!! nl2br(e($article->article_contents)) !!}</p>
               </div>
            </header>
        </article>
    </div>
</main>

