<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner; // モデルのインポート。Banner::create のように短く書きたい場合は、ファイルの先頭で 「Banner モデルはここにありますよ！」 と教えてあげる（use する）必要がある

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Banner::create([
            'id'    => 1,
            // 指示書のルール通り「storage/images/banner/ファイル名」で保存
            'image' => 'storage/images/banner/banner_test1.png', 
        ]);
    }
}
