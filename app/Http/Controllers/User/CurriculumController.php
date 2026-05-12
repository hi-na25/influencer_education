<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Userモデルも使う場合
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function showCurriculumList(Request $request)
    {
        // --- 開発用：未ログイン時はID 1のユーザーでログインさせる ---
        if (!Auth::check()) {
            $user = User::find(1);
            if ($user) {
                Auth::login($user);
            }
        }


        // --- 1. URLから月と学年を受け取る ---
        $targetDate = $request->input('date')
            ? Carbon::parse($request->input('date'))->startOfMonth()
            : Carbon::now()->startOfMonth();

        // 学年の受け取り
        $selectedGrade = $request->input('grade', Auth::user()->grade_id);


        // --- 2. DBからデータを絞り込む ---
        $curriculums = Curriculum::forSelectedGrade($selectedGrade, $targetDate)->get();



        // --- ★ Ajax 対応 ---
        // 学年名のリスト（バッジ更新用）
        // IDをキーに、名前を値にした配列をDBから取得
        $gradeNames = \App\Models\Grade::pluck('name', 'id');


        // Ajax（非同期）リクエストの場合
        if ($request->ajax()) {
            return response()->json([
                // カード一覧の部品だけをHTMLにする
                'html'          => view('user._curriculum_list', compact('curriculums'))->render(),
                'displayDate'   => $targetDate->format('Y年n月'),
                'currentMonth'  => $targetDate->format('Y-m'),
                'selectedGrade' => (int)$selectedGrade,
                'gradeName'     => $gradeNames[$selectedGrade] ?? '',
                'prevMonth'     => $targetDate->copy()->subMonth()->format('Y-m'),
                'nextMonth'     => $targetDate->copy()->addMonth()->format('Y-m'),
            ]);
        }


        // 画面に渡すデータ
        return view('user.curriculum_list', [
            'displayDate'   => $targetDate->format('Y年n月'),
            'prevMonth'     => $targetDate->copy()->subMonth()->format('Y-m'),
            'nextMonth'     => $targetDate->copy()->addMonth()->format('Y-m'),
            'targetDate'    => $targetDate,
            'selectedGrade' => $selectedGrade,
            'curriculums'   => $curriculums,
            'gradeNames'    => $gradeNames,
        ]);
    }

    public function showDelivery(int $id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('user.delivery', ['curriculum' => $curriculum]);
    }
}
