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
                'japan_region_id' => '3',
                'name' => '東京',
        ]);
        DB::table('japan_locations')->insert([
                'japan_region_id' => '5',
                'name' => '京都',
        ]);
        DB::table('japan_locations')->insert([
                'japan_region_id' => '4',
                'name' => '静岡',
        ]);
    }
}
