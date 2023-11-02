<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JapanRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('japan_regions')->insert([
                'name' => '北海道',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '東北',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '関東',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '中部',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '近畿',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '中国',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '四国',
        ]);
        DB::table('japan_regions')->insert([
                'name' => '九州',
        ]);
    }
}
