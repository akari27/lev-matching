<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

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
                ['name' => 'スポーツ'],
                ['name' => 'アウトドア'],
                ['name' => '料理・グルメ'],
                ['name' => '美容'],
                ['name' => '芸術'],
                ['name' => '音楽'],
                ['name' => 'アニメ・ゲーム'],
        ]);
    }
}
