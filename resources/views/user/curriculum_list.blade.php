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
                {{-- ◀ に前月のリンクを貼る --}}
                <a href="{{ route('user.show.curriculum', ['date' => $prevMonth]) }}">◀</a>
                
                {{-- ここを変数にする --}}
                <span class="h4 mx-3">{{ $displayDate }} スケジュール</span>
                
                {{-- ▶ に次月のリンクを貼る --}}
                <a href="{{ route('user.show.curriculum', ['date' => $nextMonth]) }}">▶</a>
            </div>
            </div>
        </div>
    </div>

    {{-- メインエリア --}}
    <div class="row">

        {{-- 左メニュー --}}
        <div class="col-md-2">
            <div class="d-flex flex-column align-items-center gap-2"> {{-- ボタンを縦に並べる --}}
                <button class="sidebar-btn btn-elementary">小学校1年生</button>
                <button class="sidebar-btn btn-elementary">小学校2年生</button>
                <button class="sidebar-btn btn-elementary">小学校3年生</button>
                <button class="sidebar-btn btn-elementary">小学校4年生</button>
                <button class="sidebar-btn btn-elementary">小学校5年生</button>
                <button class="sidebar-btn btn-elementary">小学校6年生</button>
                
                <button class="sidebar-btn btn-junior-high">中学校1年生</button>
                <button class="sidebar-btn btn-junior-high">中学校2年生</button>
                <button class="sidebar-btn btn-junior-high">中学校3年生</button>
                
                <button class="sidebar-btn btn-high-school">高校1年生</button>
                <button class="sidebar-btn btn-high-school">高校2年生</button>
                <button class="sidebar-btn btn-high-school">高校3年生</button>
            </div>
        </div>

        {{-- 右コンテンツ --}}
        <div class="col-md-10">
            <div class="row"> {{-- カード同士を横並びにするための row --}}

                {{-- サンプル1 --}}
                <div class="col-md-4 mb-4"> {{-- 10個のうちのさらに4つ分（つまり3つ並ぶ） --}}
                                            <!-- mb-4 : m: Margin（外側の余白）,m: Margin（外側の余白）,4: Bootstrapで決まっているサイズ -->
                    <div class="curriculum-card">
                        <div class="card-img-wrapper">
                            <img src="{{ asset('img/sample.jpg') }}" alt="授業イメージ">
                        </div>
                        <div class="card-body-custom">
                            <h5 class="curriculum-title">授業タイトルが入ります</h5>
                            <ul class="schedule-list">
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- サンプル2 --}}
                <div class="col-md-4 mb-4"> {{-- 10個のうちのさらに4つ分（つまり3つ並ぶ） --}}
                    <div class="curriculum-card">
                        <div class="card-img-wrapper">
                            <img src="https://via.placeholder.com/300x150" alt="授業イメージ">
                        </div>
                        <div class="card-body-custom">
                            <h5 class="curriculum-title">授業タイトルが入ります</h5>
                            <ul class="schedule-list">
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- サンプル3 --}} 
                <div class="col-md-4 mb-4"> {{-- 10個のうちのさらに4つ分（つまり3つ並ぶ） --}}
                    <div class="curriculum-card">
                        <div class="card-img-wrapper">
                            <img src="https://via.placeholder.com/300x150" alt="授業イメージ">
                        </div>
                        <div class="card-body-custom">
                            <h5 class="curriculum-title">授業タイトルが入ります</h5>
                            <ul class="schedule-list">
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                            </ul>
                        </div>
                    </div>

                {{-- サンプル4 --}}
                </div><div class="col-md-4 mb-4"> {{-- 10個のうちのさらに4つ分（つまり3つ並ぶ） --}}
                    <div class="curriculum-card">
                        <div class="card-img-wrapper">
                            <img src="https://via.placeholder.com/300x150" alt="授業イメージ">
                        </div>
                        <div class="card-body-custom">
                            <h5 class="curriculum-title">授業タイトルが入ります</h5>
                            <ul class="schedule-list">
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                                <li class="schedule-item">7月13日 14:00 ～ 15:00</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection