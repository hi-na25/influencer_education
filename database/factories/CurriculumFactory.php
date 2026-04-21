<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Faker（フェイカー）という機能を使って、本物っぽいデータを生成します
            'title'               => $this->faker->realText(20),      // 日本語で20文字程度のタイトル
            'thumbnail'           => 'https://placehold.jp/24/cccccc/ffffff/400x300.png?text=Curriculum', // 仮画像
            'description'         => $this->faker->realText(100),     // 100文字程度の説明
            'video_url'           => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'alway_delivery_flg' => 1,
            'grade_id'            => 4, // いま画面を作っている「4年生」に固定しておきます
        ];
    }
}
