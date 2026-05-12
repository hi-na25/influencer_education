<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 一旦中身を空にする（二重登録防止）
        DB::table('curriculums')->delete();

        // テストデータを追加
        $params = [
            // 小学校1年生 (grade_id: 1)
            ['title' => '授業タイトル1', 'grade_id' => 1, 'alway_delivery_flg' => 1],
            ['title' => '授業タイトル2', 'grade_id' => 1, 'alway_delivery_flg' => 1],
            ['title' => '授業タイトル3', 'grade_id' => 1, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル4', 'grade_id' => 1, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル5', 'grade_id' => 1, 'alway_delivery_flg' => 0],

            // 小学校2年生 (grade_id: 2)
            ['title' => '授業タイトル1', 'grade_id' => 2, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 2, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 2, 'alway_delivery_flg' => 0],
 
            // 小学校3年生 (grade_id: 3)
            ['title' => '授業タイトル1', 'grade_id' => 3, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 3, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 3, 'alway_delivery_flg' => 0],

            // 小学校4年生 (grade_id: 4)
            ['title' => '授業タイトル1', 'grade_id' => 4, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 4, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 4, 'alway_delivery_flg' => 0],

            // 小学校5年生 (grade_id: 5)
            ['title' => '授業タイトル1', 'grade_id' => 5, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 5, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 5, 'alway_delivery_flg' => 0],

            // 小学校6年生 (grade_id: 6)
            ['title' => '授業タイトル1', 'grade_id' => 6, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 6, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 6, 'alway_delivery_flg' => 0],

            // 中学校1年生 (grade_id: 7)
            ['title' => '授業タイトル1', 'grade_id' => 7, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 7, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 7, 'alway_delivery_flg' => 0],

            // 中学校2年生 (grade_id: 8)
            ['title' => '授業タイトル1', 'grade_id' => 8, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 8, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 8, 'alway_delivery_flg' => 0],

            // 中学校3年生 (grade_id: 9)
            ['title' => '授業タイトル1', 'grade_id' => 9, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 9, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 9, 'alway_delivery_flg' => 0],

            // 高校1年生 (grade_id: 10)
            ['title' => '授業タイトル1', 'grade_id' => 10, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 10, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 10, 'alway_delivery_flg' => 0],

            // 高校2年生 (grade_id: 11)
            ['title' => '授業タイトル1', 'grade_id' => 11, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 11, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 11, 'alway_delivery_flg' => 0],

            // 高校3年生 (grade_id: 12)
            ['title' => '授業タイトル1', 'grade_id' => 12, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル2', 'grade_id' => 12, 'alway_delivery_flg' => 0],
            ['title' => '授業タイトル3', 'grade_id' => 12, 'alway_delivery_flg' => 0],
        ];
        foreach ($params as $param) {
            \DB::table('curriculums')->insert($param);
        }
    }
}