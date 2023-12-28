<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert([
            [
                'sender_id' => '8',
                'receiver_id' => '1',
                'message' => 'こんにちは！'
            ],
            [
                'sender_id' => '2',
                'receiver_id' => '7',
                'message' => 'こんにちは！'
            ]
            ]);
    }
}
