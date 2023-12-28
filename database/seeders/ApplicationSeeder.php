<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            [
                'sender_id' => '1',
                'receiver_id' => '8',
                'permission_flag' => '1',
            ],
            [
                'sender_id' => '9',
                'receiver_id' => '1',
                'permission_flag' => '0',
            ],
            [
                'sender_id' => '7',
                'receiver_id' => '2',
                'permission_flag' => '1',
            ],
            [
                'sender_id' => '3',
                'receiver_id' => '7',
                'permission_flag' => '0',
            ],
            ]);
    }
}
