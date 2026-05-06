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
        $curriculums = Curriculum::where('grade_id', $selectedGrade)
            ->where(function ($query) use ($targetDate) {
                // 1. 常時公開フラグが 1 のもの
                $query->where('alway_delivery_flg', 1)
                    // 2. または、配信期間が指定の年月と一致するもの
                    ->orWhereHas('deliveryTimes', function ($q) use ($targetDate) {
                        $q->whereYear('delivery_from', $targetDate->year)
                            ->whereMonth('delivery_from', $targetDate->month);
                    });
            })

            ->leftJoin('delivery_times', function ($join) {
                $join->on('curriculums.id', '=', 'delivery_times.curriculums_id');
            })
            ->select('curriculums.*', DB::raw('MIN(delivery_times.delivery_from) as first_delivery'))
            ->groupBy('curriculums.id') // distinctの代わりにgroupByでまとめる
            ->orderByRaw('CASE WHEN alway_delivery_flg = 1 THEN 0 ELSE 1 END')
            ->orderBy('first_delivery', 'asc')

            ->get();



        // --- ★ Ajax 対応 ---
        // 学年名のリスト（バッジ更新用）
        $gradeNames = [
            1 => '小学校1年生',
            2 => '小学校2年生',
            3 => '小学校3年生',
            4 => '小学校4年生',
            5 => '小学校5年生',
            6 => '小学校6年生',
            7 => '中学校1年生',
            8 => '中学校2年生',
            9 => '中学校3年生',
            10 => '高校1年生',
            11 => '高校2年生',
            12 => '高校3年生'
        ];

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
        ]);
    }

    public function showDelivery(int $id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('user.delivery', ['curriculum' => $curriculum]);
    }
}
