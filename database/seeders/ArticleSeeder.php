<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article; // モデルを使うための宣言
use Carbon\Carbon; // 時計ツールを使うための宣言

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Article::create([
            'title'            => '夏期講習の受付を開始しました',
            'posted_date'      => Carbon::now()->format('Y-m-d'), // 今日の日付
            'article_contents' => '本日から夏期講習の申し込みを開始します。詳細は...',
        ]);

        Article::create([
            'title'            => 'システムメンテナンスのお知らせ',
            'posted_date'      => Carbon::now()->subDays(3)->format('Y-m-d'), // 3日前
            'article_contents' => '以下の日程でメンテナンスを行います...',
        ]);
    }
}
