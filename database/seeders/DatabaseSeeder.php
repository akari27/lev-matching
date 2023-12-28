<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GeoDivisionSeeder::class,
            CountrySeeder::class,
            JapanRegionSeeder::class,
            JapanLocationSeeder::class,
            HobbyCategorySeeder::class,
            JapaneseSeeder::class,
            ForeignVisitorSeeder::class,
            ApplicationSeeder::class,
            ChatSeeder::class,
        ]);
    }
}

