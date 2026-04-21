<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // 利用者テーブル（users）にデータを入れる
        // 利用者は「学年(grade_id)」を持っているはずなので、それを忘れずに！
        \App\Models\User::create([
            'id'        => 1,
            'name'      => 'テストユーザー太郎',
            'name_kana' => 'テストユーザータロウ',
            'email'     => 'user@example.com',
            'password'  => bcrypt('password'),
            'grade_id'  => 4, // 4年生として作成
        ]);

        // Factoryを使って一般ユーザーをたくさん作るなら
        // \App\Models\User::factory(10)->create();
    }
}
