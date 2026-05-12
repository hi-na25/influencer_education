<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加

class DeliveryTime extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ひとまず共通の時間を変数に入れておく
        $now = now();

        // DeliveryTimeSeeder.php の中身（例）
        DB::table('delivery_times')->insert([
            [
                'curriculums_id' => 1, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 2, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,

            ],
            [
                'curriculums_id' => 3, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 4, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 5, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 6, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 7, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 8, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 9, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'curriculums_id' => 10, // 実在するカリキュラムのIDを指定
                'delivery_from'  => '2026-04-01 10:00:00',
                'delivery_to'    => '2026-04-01 12:00:00',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ]);
    }
}
