<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'テスト',
            'email' => 'test@test',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '0',
            'is_japanese' => '0',
            'hobby_category_id' => '1',
        ]);
    }
}
