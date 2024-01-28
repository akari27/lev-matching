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
            'hobby_category_id' => '6',
            'comment' => 'J-POPが好きなので、今回の旅行では日本の音楽を楽しみたいです！',
            'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1705548454/%E9%9F%93%E5%9B%BD%E9%9F%B3%E6%A5%BD_wkcecx.png',
        ]);
        //// 仮ユーザ
        DB::table('users')->insert([
            [
                'name' => 'Malik Khan',
                'email' => 'malikkhan@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '31',
                'is_japanese' => '0',
                'hobby_category_id' => '1',
                'comment' => '日本のスポーツイベントに興味があります。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1705548677/%E3%83%8F%E3%82%9A%E3%82%AD%E3%82%B9%E3%82%BF%E3%83%B3_gjzcbj.png',
            ],
            [
                'name' => 'Chen Mei Ling',
                'email' => 'meilingchen@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '33',
                'is_japanese' => '0',
                'hobby_category_id' => '2',
                'comment' => '日本の美しい自然を心ゆくまで堪能します。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1705548463/%E4%B8%AD%E5%9B%BD%E5%A5%B3%E6%80%A7_zex52o.png',
            ],
            [
                'name' => 'Somchai Srisawat',
                'email' => 'somchaisrisawat@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '39',
                'is_japanese' => '0',
                'hobby_category_id' => '3',
                'comment' => '日本の料理を楽しみたいです。八ツ橋を持ち帰りたい！',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1706436919/%E3%82%BF%E3%82%A4_xckh9k.png',
            ],
            [
                'name' => 'Kim Min-ji',
                'email' => 'minjikim@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '29',
                'is_japanese' => '0',
                'hobby_category_id' => '4',
                'comment' => '日本の化粧品が好きです。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1705549550/%E9%9F%93%E5%9B%BD%E7%BE%8E%E5%AE%B9_ug9vsc.png',
            ],
            [
                'name' => 'Aishwarya Gupta',
                'email' => 'aishwaryagupta@gmail.com', 
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '1',
                'age' => '26',
                'is_japanese' => '0',
                'hobby_category_id' => '5',
                'comment' => '日本の伝統的な芸術に感動しています。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1705549550/%E3%82%A4%E3%83%B3%E3%83%88%E3%82%99%E5%A5%B3%E6%80%A7_gvbwve.png',
            ],
            [
                'name' => 'Nguyen Van Minh',
                'email' => 'vanminhnguyen@gmail.com',
                'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
                'gender_flag' => '0',
                'age' => '36',
                'is_japanese' => '0',
                'hobby_category_id' => '7',
                'comment' => '日本のアニメが好きです。秋葉原に寄ってみたい。',
                'image_url' => 'https://res.cloudinary.com/ddsaj5dfs/image/upload/v1706436691/%E3%83%98%E3%82%99%E3%83%88%E3%83%8A%E3%83%A0_t1bzsp.png',
            ],
        ]);
    }
}
