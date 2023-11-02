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
        DB::table('countrys')->insert([
                'geo_division_id' => '1',
                'name' => 'インドネシア',
        ]);
        DB::table('countrys')->insert([
                'geo_division_id' => '2',
                'name' => 'フランス',
        ]);
        DB::table('countrys')->insert([
                'geo_division_id' => '2',
                'name' => 'オランダ',
        ]);
    }
}
