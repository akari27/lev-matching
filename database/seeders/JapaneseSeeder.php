<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class JapaneseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('japaneses')->insert([
                // テスト用アカウント
                ['user_id' => '1','register_location_id' => '1','often_go_location_id' => '1'],
                // 仮ユーザ
                ['user_id' => '2','register_location_id' => '12','often_go_location_id' => '13'],
                ['user_id' => '3','register_location_id' => '28','often_go_location_id' => '29'],
                ['user_id' => '4','register_location_id' => '1','often_go_location_id' => '3'],
                ['user_id' => '5','register_location_id' => '40','often_go_location_id' => '41'],
                ['user_id' => '6','register_location_id' => '25','often_go_location_id' => '26'],
        ]);
    }
}