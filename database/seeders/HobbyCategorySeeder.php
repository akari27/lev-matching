<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hobby_categories')->insert([
                'name' => '音楽',
        ]);
        DB::table('hobby_categories')->insert([
                'name' => 'スポーツ',
        ]);
        DB::table('hobby_categories')->insert([
                'name' => '料理',
        ]);
        DB::table('hobby_categories')->insert([
                'name' => '芸術',
        ]);
        DB::table('hobby_categories')->insert([
                'name' => 'ゲーム',
        ]);
        DB::table('hobby_categories')->insert([
                'name' => 'アニメ・漫画',
        ]);
    }
}
