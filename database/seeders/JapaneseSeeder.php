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
                'user_id' => '1',
                'register_location_id' => '1',
                'often_go_location_id' => '1',
        ]);
        DB::table('japaneses')->insert([
                'user_id' => '2',
                'register_location_id' => '1',
                'often_go_location_id' => '2',
        ]);
        DB::table('japaneses')->insert([
                'user_id' => '3',
                'register_location_id' => '1',
                'often_go_location_id' => '3',
        ]);
        DB::table('japaneses')->insert([
                'user_id' => '4',
                'register_location_id' => '2',
                'often_go_location_id' => '1',
        ]);
        DB::table('japaneses')->insert([
                'user_id' => '5',
                'register_location_id' => '2',
                'often_go_location_id' => '3',
        ]);
        DB::table('japaneses')->insert([
                'user_id' => '6',
                'register_location_id' => '3',
                'often_go_location_id' => '1',
        ]);
    }
}