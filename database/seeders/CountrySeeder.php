<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['geo_division_id' => '1','name' => 'インド'],
            ['geo_division_id' => '1','name' => 'インドネシア'],
            ['geo_division_id' => '1','name' => 'カンボジア'],
            ['geo_division_id' => '1','name' => 'シンガポール'],
            ['geo_division_id' => '1','name' => 'スリランカ'],
            ['geo_division_id' => '1','name' => 'タイ'],
            ['geo_division_id' => '1','name' => '韓国'],
            ['geo_division_id' => '1','name' => '中国'],
            ['geo_division_id' => '1','name' => 'ネパール'],
            ['geo_division_id' => '1','name' => 'パキスタン'],
            ['geo_division_id' => '1','name' => 'バングラデシュ'],
            ['geo_division_id' => '1','name' => '東ティモール'],
            ['geo_division_id' => '1','name' => 'フィリピン'],
            ['geo_division_id' => '1','name' => 'ブータン'],
            ['geo_division_id' => '1','name' => 'ブルネイ'],
            ['geo_division_id' => '1','name' => 'ベトナム'],
            ['geo_division_id' => '1','name' => 'マレーシア'],
            ['geo_division_id' => '1','name' => 'ミャンマー'],
            ['geo_division_id' => '1','name' => 'モルディブ'],
            ['geo_division_id' => '1','name' => 'モンゴル'],
            ['geo_division_id' => '1','name' => 'ラオス'],
            ['geo_division_id' => '1','name' => '台湾'],
            ['geo_division_id' => '1','name' => '香港'],
            ['geo_division_id' => '1','name' => 'マカオ'],
        ]);
        
        
    }
}
