<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {

        $this->call([
            GradeSeeder::class,    // 1. まず学年を作る（最優先！）
            AdminSeeder::class,
            UserSeeder::class,     // 2. 学年に紐づくユーザーを作る
            CurriculumSeeder::class, // 3. 学年に紐づく授業を作る
            ArticleSeeder::class,
            BannerSeeder::class,
            DeliveryTime::class,
          　CurriculumsTableSeeder::class
        ]);
    }
}
