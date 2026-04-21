<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Curriculumモデルに、「Factoryを使って10件作って、DBに保存（create）して」と命令
        \App\Models\Curriculum::factory()->count(10)->create();
    }
}
