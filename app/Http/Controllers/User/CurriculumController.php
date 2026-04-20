<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // 月移動
use Carbon\Carbon;           // 日付操作に便利




class CurriculumController extends Controller
{
    // URLから日付を取得（なければ今月）
    public function showCurriculumList(Request $request) // Requestを受け取る
    {
        // URLに date があればそれを使う。なければ今月の1日をセット。
        $targetDate = $request->input('date') 
            ? Carbon::parse($request->input('date'))->startOfMonth() 
            : Carbon::now()->startOfMonth();

        // 前月と次月の「YYYY-MM」形式の文字列を作る（矢印のリンク用）
        $prevMonth = $targetDate->copy()->subMonth()->format('Y-m');
        $nextMonth = $targetDate->copy()->addMonth()->format('Y-m');

        // 画面に渡すデータ（見出し用やリンク用）
        return view('user.curriculum_list', [
            'displayDate' => $targetDate->format('Y年n月'), // 2023年7月
            'prevMonth'   => $prevMonth,
            'nextMonth'   => $nextMonth,
        ]);
    }
}