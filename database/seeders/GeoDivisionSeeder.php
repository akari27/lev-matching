<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geo_divisions')->insert([
                'name' => 'アジア',
        ]);
        DB::table('geo_divisions')->insert([
                'name' => 'ヨーロッパ',
        ]);
    }
}
