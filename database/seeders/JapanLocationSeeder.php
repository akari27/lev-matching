<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class JapanLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('japan_locations')->insert([
            ['japan_region_id' => 1, 'name' => '北海道'],
            ['japan_region_id' => 2, 'name' => '青森県'],
            ['japan_region_id' => 2, 'name' => '岩手県'],
            ['japan_region_id' => 2, 'name' => '宮城県'],
            ['japan_region_id' => 2, 'name' => '秋田県'],
            ['japan_region_id' => 2, 'name' => '山形県'],
            ['japan_region_id' => 2, 'name' => '福島県'],
            ['japan_region_id' => 3, 'name' => '茨城県'],
            ['japan_region_id' => 3, 'name' => '栃木県'],
            ['japan_region_id' => 3, 'name' => '群馬県'],
            ['japan_region_id' => 3, 'name' => '埼玉県'],
            ['japan_region_id' => 3, 'name' => '千葉県'],
            ['japan_region_id' => 3, 'name' => '東京都'],
            ['japan_region_id' => 3, 'name' => '神奈川県'],
            ['japan_region_id' => 4, 'name' => '新潟県'],
            ['japan_region_id' => 4, 'name' => '富山県'],
            ['japan_region_id' => 4, 'name' => '石川県'],
            ['japan_region_id' => 4, 'name' => '福井県'],
            ['japan_region_id' => 4, 'name' => '山梨県'],
            ['japan_region_id' => 4, 'name' => '長野県'],
            ['japan_region_id' => 4, 'name' => '岐阜県'],
            ['japan_region_id' => 4, 'name' => '静岡県'],
            ['japan_region_id' => 4, 'name' => '愛知県'],
            ['japan_region_id' => 5, 'name' => '三重県'],
            ['japan_region_id' => 5, 'name' => '滋賀県'],
            ['japan_region_id' => 5, 'name' => '京都府'],
            ['japan_region_id' => 5, 'name' => '大阪府'],
            ['japan_region_id' => 5, 'name' => '兵庫県'],
            ['japan_region_id' => 5, 'name' => '奈良県'],
            ['japan_region_id' => 5, 'name' => '和歌山県'],
            ['japan_region_id' => 6, 'name' => '鳥取県'],
            ['japan_region_id' => 6, 'name' => '島根県'],
            ['japan_region_id' => 6, 'name' => '岡山県'],
            ['japan_region_id' => 6, 'name' => '広島県'],
            ['japan_region_id' => 6, 'name' => '山口県'],
            ['japan_region_id' => 7, 'name' => '徳島県'],
            ['japan_region_id' => 7, 'name' => '香川県'],
            ['japan_region_id' => 7, 'name' => '愛媛県'],
            ['japan_region_id' => 7, 'name' => '高知県'],
            ['japan_region_id' => 8, 'name' => '福岡県'],
            ['japan_region_id' => 8, 'name' => '佐賀県'],
            ['japan_region_id' => 8, 'name' => '長崎県'],
            ['japan_region_id' => 8, 'name' => '熊本県'],
            ['japan_region_id' => 8, 'name' => '大分県'],
            ['japan_region_id' => 8, 'name' => '宮崎県'],
            ['japan_region_id' => 8, 'name' => '鹿児島県'],
            ['japan_region_id' => 8, 'name' => '沖縄県'],
        ]);
    }
}
