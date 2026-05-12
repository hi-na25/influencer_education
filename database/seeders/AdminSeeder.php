<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
{
    // 管理者テーブル（admins）にデータを入れる
    \App\Models\Admin::create([
        'id'       => 1,
        'name'     => 'システム管理者',
        'kana'     => 'システムカンリシャ',
        'email'    => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);
}
}
