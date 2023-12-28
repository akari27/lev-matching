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
        // 日本人
        //// テスト用アカウント
        DB::table('users')->insert([
            'name' => '旅行太郎',
            'email' => 'ryokotaro@gmail.com',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '20',
            'is_japanese' => '1',
            'hobby_category_id' => '2',
            'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1703410307/uwsobyu5kxobnhomgxzv.png',
        ]);
        //// 仮ユーザ
        DB::table('users')->insert([
            [
                'name' => '田中さくら',
                'email' => 'tanakasakura@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '28',
                'is_japanese' => '1',
                'hobby_category_id' => '3',
                'comment' => 'カフェ巡りが趣味で、東京にあるカフェがお気に入りです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1703410896/face_night_unmt9n.png'
            ],
            [
                'name' => '山田太郎',
                'email' => 'yamadataro@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '35',
                'is_japanese' => '1',
                'hobby_category_id' => '2',
                'comment' => '仕事が忙しい日々ですが、週末には奈良で歴史を感じながら散歩するのが癒しです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1703411500/travel_happy_family_set_ueserl.png',
            ],
            [
                'name' => '伊藤悠美',
                'email' => 'itoyumi@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '24',
                'is_japanese' => '1',
                'hobby_category_id' => '3',
                'comment' => '北海道の良いところ案内できます。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1703411617/kids_hashirimawaru_snow_jmbwwx.png',
            ],
            [
                'name' => '渡辺健太',
                'email' => 'watanabekenta@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '31',
                'is_japanese' => '1',
                'hobby_category_id' => '1',
                'comment' => '九州の美味しいものを求めて、週末には佐賀までドライブに行くことがよくあります。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1700989424/sckqod2emfnlerzilrv5.png',
            ],
            [
                'name' => '中村美咲',
                'email' => 'nakamuramisaki@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '22',
                'is_japanese' => '1',
                'hobby_category_id' => '2',
                'comment' => '京都の伝統と文化が大好きです。琵琶湖も好きです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701073198/bh31shlxopemtmqgxmoi.jpg',
            ]
        ]);
        
        // 外国人
        //// テスト用アカウント
        DB::table('users')->insert([
            'name' => 'Kim So-Yeon',
            'email' => 'kimsoyeon@gmail.com',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '30',
            'is_japanese' => '0',
            'hobby_category_id' => '1',
            'comment' => 'J-POPが好きなので、今回の旅行では日本の音楽を楽しみたいです！',
            'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701072950/mafkygf7mnq5fivkvtnf.png',
        ]);
        //// 仮ユーザ
        DB::table('users')->insert([
            [
                'name' => 'Juan Rodriguez',
                'email' => 'juanrodriguez@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '25',
                'is_japanese' => '0',
                'hobby_category_id' => '2',
                'comment' => '日本の先進的なテクノロジーとアートに触れるのが楽しみです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701072921/prv84gxut3epxastvlcx.png'
            ],
            [
                'name' => 'Aya Khan',
                'email' => 'ayakhan@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '28',
                'is_japanese' => '0',
                'hobby_category_id' => '3',
                'comment' => 'お好み焼きが楽しみです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701072950/mafkygf7mnq5fivkvtnf.png',
            ],
            [
                'name' => 'Luca Ferrari',
                'email' => 'lucaferrari@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '35',
                'is_japanese' => '0',
                'hobby_category_id' => '1',
                'comment' => '北海道の雪まつりは写真で見たことがあり、実際に体験するのが楽しみです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701072921/prv84gxut3epxastvlcx.png',
            ],
            [
                'name' => 'Mei Chen',
                'email' => 'meichen@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '22',
                'is_japanese' => '0',
                'hobby_category_id' => '2',
                'comment' => '日本の伝統的な神社やお祭りに参加するのが楽しみです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1701072950/mafkygf7mnq5fivkvtnf.png',
            ]
        ]);
    }
}
