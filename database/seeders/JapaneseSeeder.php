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
                'user_id' => '',
                'register_location_id' => '',
                'often_go_location_id' => '',
        ]);
    }
}
