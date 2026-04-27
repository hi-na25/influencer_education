<div class="row"> {{-- カード同士を横並びにするための row --}}

    @foreach($curriculums as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm bg-white curriculum-card">                            
                <div class="p-3 pb-0">
                    {{-- 画像がある場合 --}}
                    @if($item->thumbnail)
                        <img src="{{ asset($item->thumbnail) }}" 
                            class="card-img-top curriculum-card__img-wrapper" 
                            alt="{{ $item->title }}">
                    @else
                        {{-- 画像がない場合（規約遵守：クラス名で指定） --}}
                        <div class="curriculum-card__img-wrapper curriculum-card__img-wrapper--empty">
                            No Image
                        </div>
                    @endif
                </div>
                
                <div class="card-body">
                    <a href="{{ route('user.show.delivery', ['id' => $item->id]) }}"
                    class="text-decoration-none text-dark d-block">
                        
                        {{-- タイトル --}}
                        <h5 class="card-title font-weight-bold curriculum-card__title">
                            {{ $item->title }}
                        </h5>
                        
                        {{-- 配信情報 --}}
                        <div class="delivery-info text-muted curriculum-card__delivery-info">
                            @if($item->alway_delivery_flg == 1)
                                {{-- 常時公開フラグがオンの場合 --}}
                                <div class="text-primary font-weight-bold">常時公開</div>
                            @else
                                {{-- 日時指定がある場合 --}}
                                @foreach($item->deliveryTimes->sortBy('delivery_from') as $time)
                                    @php
                                        // 開始日と終了日を Carbon でパース
                                        $start = \Carbon\Carbon::parse($time->delivery_from);
                                        $end = \Carbon\Carbon::parse($time->delivery_to);
                                        
                                        // 開始日と終了日が「同じ日」かどうかを判定
                                        $isSameDay = $start->isSameDay($end);
                                    @endphp

                                    <div>
                                        {{ $start->format('n月j日 H:i') }} ～ 
                                        @if($isSameDay)
                                            {{-- 同じ日なら時間だけ表示 --}}
                                            {{ $end->format('H:i') }}
                                        @else
                                            {{-- 日をまたぐなら終了日も表示 --}}
                                            {{ $end->format('n月j日 H:i') }}
                                        @endif
                                    </div>
                                @endforeach

                                {{-- もしデータがない場合の予備表示 --}}
                                @if($item->deliveryTimes->isEmpty())
                                    <div>配信日時未定</div>
                                @endif
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

</div>