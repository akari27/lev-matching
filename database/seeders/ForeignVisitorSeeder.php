<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ForeignVisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テスト用アカウント
        DB::table('foreign_visitors')->insert([
            'user_id' => '7',
            // 韓国
            'register_location_id' => '7',
            // 東京か千葉にする
            'stay_location_id' => '12',
            'start_of_stay' => '2024-07-20',
            'end_of_stay' => '2024-07-30',
            'reason' => '日本の音楽が好きで音楽フェスに行きたいから',
        ]);
        // 仮ユーザ
        DB::table('foreign_visitors')->insert([
            [
                'user_id' => '8',
                // パキスタン
                'register_location_id' => '10',
                // 福岡
                'stay_location_id' => '40',
                'start_of_stay' => '2024-05-20',
                'end_of_stay' => '2024-06-10',
                'reason' => 'スポーツ観戦',
            ],
            [
                'user_id' => '9',
                // 中国
                'register_location_id' => '8',
                // 北海道
                'stay_location_id' => '1',
                'start_of_stay' => '2024-08-15',
                'end_of_stay' => '2024-09-05',
                'reason' => '自然・リラックス',
            ],
            [
                'user_id' => '10',
                // タイ
                'register_location_id' => '6',
                // 京都
                'stay_location_id' => '26',
                'start_of_stay' => '2024-04-10',
                'end_of_stay' => '2024-04-30',
                'reason' => 'グルメ巡り',
            ],
            [
                'user_id' => '11',
                // 韓国
                'register_location_id' => '7',
                // 大阪
                'stay_location_id' => '27',
                'start_of_stay' => '2024-03-20',
                'end_of_stay' => '2024-03-30',
                'reason' => '東京観光・カフェ巡り・買い物',
            ],
            [
                'user_id' => '12',
                // インド
                'register_location_id' => '1',
                // 東京
                'stay_location_id' => '13',
                'start_of_stay' => '2024-01-20',
                'end_of_stay' => '2024-01-30',
                'reason' => '日本文化を知る',
            ],
            [
                'user_id' => '13',
                // ベトナム
                'register_location_id' => '16',
                // 東京
                'stay_location_id' => '13',
                'start_of_stay' => '2024-02-20',
                'end_of_stay' => '2024-02-29',
                'reason' => '日本のテクノロジーに触れる・買い物',
            ],
        ]);
    }
}
