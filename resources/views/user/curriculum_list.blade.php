@extends('user.layouts.app')

@section('title', '授業一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user/curriculum_list.css') }}">
@endpush

@section('content')
<div class="container-fluid"> {{-- 全体を囲む --}}
    
    {{-- 上部のナビ部分 --}}
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center">
            <a href="{{ route('user.show.top') }}" class="text-decoration-none">←戻る</a>
            <div class="calendar-nav ms-3 text-start">
                {{-- 前月リンク --}}
                <a href="{{ route('user.show.curriculum', ['date' => $prevMonth, 'grade' => $selectedGrade]) }}">
                    ◀ 前月
                </a>
                
                {{-- ここを変数にする --}}
                <span class="h4 mx-3">{{ $displayDate }} スケジュール</span>
                
                {{-- 次月リンク --}}
                <a href="{{ route('user.show.curriculum', ['date' => $nextMonth, 'grade' => $selectedGrade]) }}">
                    次月 ▶
                </a>
            </div>
            
            @if($selectedGrade)
                <div class="selected-grade-badge ms-5 mt-3">
                    {{-- gradeの数字によって表示する文字を出し分け --}}
                    @php
                        $gradeNames = [
                            1 => '小学校1年生', 2 => '小学校2年生', 3 => '小学校3年生',
                            4 => '小学校4年生', 5 => '小学校5年生', 6 => '小学校6年生',
                            7 => '中学校1年生', 8 => '中学校2年生', 9 => '中学校3年生',
                            10 => '高校1年生', 11 => '高校2年生', 12 => '高校3年生'
                        ];
                    @endphp
                    <span class="sidebar-btn {{ $selectedGrade <= 6 ? 'btn-elementary' :
                            ($selectedGrade <= 9 ? 'btn-junior-high' : 'btn-high-school') }}
                        py-1 px-3"
                        style="width: auto; cursor: default;">
                        {{ $gradeNames[$selectedGrade] ?? '' }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- メインエリア --}}
    <div class="row">

        {{-- 左メニュー --}}
        <div class="col-md-2">
            <div class="d-flex flex-column align-items-center gap-2"> {{-- ボタンを縦に並べる --}}
                
                @php $is_disabled = 1 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 1])
                    }}" 
                    class="sidebar-btn btn-elementary text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        小学校1年生
                </a>

                @php $is_disabled = 2 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 2])
                    }}" 
                    class="sidebar-btn btn-elementary text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        小学校2年生
                </a>

                @php $is_disabled = 3 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 3])
                    }}" 
                    class="sidebar-btn btn-elementary text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        小学校3年生
                </a>

                @php $is_disabled = 4 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 4])
                    }}" 
                    class="sidebar-btn btn-elementary text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        小学校4年生
                </a>

                @php $is_disabled = 5 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 5])
                    }}" 
                    class="sidebar-btn btn-elementary text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        小学校5年生
                </a>

                @php $is_disabled = 6 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 6])
                    }}" 
                    class="sidebar-btn btn-elementary text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        小学校6年生
                </a>
                
                @php $is_disabled = 7 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 7])
                    }}" 
                    class="sidebar-btn btn-junior-high text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        中学校1年生
                </a>

                @php $is_disabled = 8 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 8])
                    }}" 
                    class="sidebar-btn btn-junior-high text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        中学校2年生
                </a>

                @php $is_disabled = 9 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 9])
                    }}" 
                    class="sidebar-btn btn-junior-high text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        中学校3年生
                </a>
                
                @php $is_disabled = 10 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 10])
                    }}" 
                    class="sidebar-btn btn-high-school text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        高校1年生
                </a>
                
                @php $is_disabled = 11 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 11])
                    }}" 
                    class="sidebar-btn btn-high-school text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        高校2年生
                </a>

                @php $is_disabled = 12 > Auth::user()->grade_id; @endphp
                <a
                    href="{{ $is_disabled
                        ? 'javascript:void(0)'
                        : route('user.show.curriculum', ['date' => $targetDate->format('Y-m'), 'grade' => 12])
                    }}" 
                    class="sidebar-btn btn-high-school text-decoration-none text-center
                        {{ $is_disabled ? 'sidebar-btn--disabled' : '' }}">
                        高校3年生
                </a>
            </div>
        </div>

        {{-- 右コンテンツ --}}
        <div class="col-md-10">
            <div class="row"> {{-- カード同士を横並びにするための row --}}

                @foreach($curriculums as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm bg-white" style="border-radius: 10px;">
                            
                            <div class="p-3 pb-0">
                                {{-- 画像がある場合 --}}
                                @if($item->thumbnail)
                                    <img src="{{ asset($item->thumbnail) }}" class="card-img-top" 
                                        style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;" 
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
                                    <h5 class="card-title font-weight-bold" style="font-size: 1rem; margin-bottom: 0.8rem;">
                                        {{ $item->title }}
                                    </h5>
                                    
                                    {{-- 配信時間 --}}
                                    <div class="delivery-info text-muted" style="font-size: 0.85rem; line-height: 1.5;">
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
        </div>
    </div>

</div>
@endsection