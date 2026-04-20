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
        // URLに date があればそれを使う。なければ今月の1日をセット。日付の計算
        $targetDate = $request->input('date') 
            ? Carbon::parse($request->input('date'))->startOfMonth() 
            : Carbon::now()->startOfMonth();


        // 学年の受け取り
        $selectedGrade = $request->input('grade'); // URLの ?grade=1 を取得

        if (!$selectedGrade) {
            // ★本来はここでDBからユーザーの進捗を取得します
            // $latestProgress = Progress::where('user_id', auth()->id())->latest()->first();
            // $selectedGrade = $latestProgress ? $latestProgress->grade : 4; // 例として4年生

            $selectedGrade = 4; // 【暫定】今は動作確認のために「4」を代入しておく。
        }





        // 前月と次月の「YYYY-MM」形式の文字列を作る（矢印のリンク用）
        $prevMonth = $targetDate->copy()->subMonth()->format('Y-m');
        $nextMonth = $targetDate->copy()->addMonth()->format('Y-m');


        // 画面に渡すデータ（見出し用やリンク用）
        return view('user.curriculum_list', [
            'displayDate' => $targetDate->format('Y年n月'), // 2023年7月
            'prevMonth'   => $prevMonth,
            'nextMonth'   => $nextMonth,
            'targetDate'    => $targetDate,   // Bladeで使うために追加
            'selectedGrade' => $selectedGrade, // 今選ばれている学年を渡す
        ]);


    }
}