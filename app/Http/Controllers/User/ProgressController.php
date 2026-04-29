<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Curriculum;

class ProgressController extends Controller
{
    public function index()
    {
            // --- 追加：ユーザー情報 ---
    $userName = '心愛あいす'; // ここを好きな名前に変えられます！
    $currentGrade = '小学校１年生';
    
    // --- 授業データ（既存のコード） ---
    $grades = [
            ['id' => 1, 'name' => '小学校1年生', 'color' => '#B2EBF2'],
            ['id' => 2, 'name' => '小学校2年生', 'color' => '#B2EBF2'],
            ['id' => 3, 'name' => '小学校3年生', 'color' => '#B2EBF2'],
            ['id' => 4, 'name' => '小学校4年生', 'color' => '#B2EBF2'],
            ['id' => 5, 'name' => '小学校5年生', 'color' => '#B2EBF2'],
            ['id' => 6, 'name' => '小学校6年生', 'color' => '#B2EBF2'],
            ['id' => 7, 'name' => '中学校1年生', 'color' => '#18f6dc'],
            ['id' => 8, 'name' => '中学校2年生', 'color' => '#18f6dc'],
            ['id' => 9, 'name' => '中学校3年生', 'color' => '#18f6dc'],
            ['id' => 7, 'name' => '高校1年生', 'color' => '#2ef646'],
            ['id' => 8, 'name' => '高校2年生', 'color' => '#2ef646'],
            ['id' => 9, 'name' => '高校3年生', 'color' => '#2ef646']
    ];
        
        // データベースから全データを取ってくる！
        $curriculums = Curriculum::all();

        // データを連れて progress.blade.php へ行く
        return view('curriculum_progress', compact('userName', 'currentGrade', 'grades', 'curriculums'));
    }
}
