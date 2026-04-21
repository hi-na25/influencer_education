<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Userモデルも使う場合

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
        $selectedGrade = $request->input('grade', Auth::user() ? Auth::user()->grade_id : 4);


        // --- 2. DBからデータを絞り込む ---
        $curriculums = Curriculum::where('grade_id', $selectedGrade)
            ->where(function($query) use ($targetDate) {
                // 1. 常時公開フラグが 1 のもの
                $query->where('alway_delivery_flg', 1)
                    // 2. または、配信期間が指定の年月と一致するもの
                    ->orWhereHas('deliveryTimes', function($q) use ($targetDate) {
                        $q->whereYear('delivery_from', $targetDate->year)
                        ->whereMonth('delivery_from', $targetDate->month);
                    });
            })

            ->leftJoin('delivery_times', function($join) {
                $join->on('curriculums.id', '=', 'delivery_times.curriculums_id');
            })
            ->select('curriculums.*', \DB::raw('MIN(delivery_times.delivery_from) as first_delivery')) 
            ->groupBy('curriculums.id') // distinctの代わりにgroupByでまとめる
            ->orderByRaw('CASE WHEN alway_delivery_flg = 1 THEN 0 ELSE 1 END')
            ->orderBy('first_delivery', 'asc')

            ->get();

        // 画面に渡すデータ
        return view('user.curriculum_list', [
            'displayDate'   => $targetDate->format('Y年n月'),
            // ここで計算して渡すのが一番安全でスッキリします！
            'prevMonth'     => $targetDate->copy()->subMonth()->format('Y-m'),
            'nextMonth'     => $targetDate->copy()->addMonth()->format('Y-m'),
            'targetDate'    => $targetDate,
            'selectedGrade' => $selectedGrade,
            'curriculums'   => $curriculums,
        ]);
    }

    public function showDelivery($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('user.delivery', ['curriculum' => $curriculum]);
    }
}