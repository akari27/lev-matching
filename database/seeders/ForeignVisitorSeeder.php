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
            'register_location_id' => '7',
            'stay_location_id' => '13',
            'start_of_stay' => '2023-07-20',
            'end_of_stay' => '2023-07-30',
            'reason' => '日本の音楽が好きで音楽フェスに行きたいから',
        ]);
        // 仮ユーザ
        DB::table('foreign_visitors')->insert([
            [
                'user_id' => '8',
                'register_location_id' => '2',
                'stay_location_id' => '2',
                'start_of_stay' => '2023-01-20',
                'end_of_stay' => '2023-01-30',
                'reason' => '観光したい',
            ],
            [
                'user_id' => '9',
                'register_location_id' => '3',
                'stay_location_id' => '3',
                'start_of_stay' => '2023-01-20',
                'end_of_stay' => '2023-01-30',
                'reason' => '日本食をたのしみたい',
            ],
            [
                'user_id' => '10',
                'register_location_id' => '1',
                'stay_location_id' => '1',
                'start_of_stay' => '2023-01-20',
                'end_of_stay' => '2023-01-30',
                'reason' => '日本の音楽が好きでライブに行きたいから',
            ],
            [
                'user_id' => '11',
                'register_location_id' => '2',
                'stay_location_id' => '2',
                'start_of_stay' => '2023-01-20',
                'end_of_stay' => '2023-01-30',
                'reason' => '買い物したい',
            ]
        ]);
    }
}
