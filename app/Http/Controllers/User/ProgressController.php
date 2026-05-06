<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\User;
use App\Models\Grade;

class ProgressController extends Controller
{
    public function index()
    {
            // --- 追加：ユーザー情報 ---
    $user = User::find(1); // IDが1番のユーザーをDBから探す
    $userName = $user->name;
    $currentGrade = $user->grade->name; // リレーションを使って学年名を取る
    
    // --- 授業データ（既存のコード） ---
    $grades = Grade::all();
        
        // データベースから全データを取ってくる！
        $curriculums = Curriculum::all();

        // ログインユーザー（あいすさん）がクリアした授業IDのリストを取得
    $clearedCurriculumIds = \DB::table('curriculum_progress') // テーブル名変更
        ->where('users_id', $user->id)
        ->where('clear_flg', 1)
        ->pluck('curriculums_id') // カラム名を curriculums_id に変更
        ->toArray();

    // データを連れて progress.blade.php へ行く
    return view('curriculum_progress', compact(
        'user', 
        'userName', 
        'currentGrade', 
        'grades', 
        'curriculums', 
        'clearedCurriculumIds'
    ));

    }
}
