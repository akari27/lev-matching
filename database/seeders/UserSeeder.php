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
        // パスワードは全員"testtest"
        DB::table('users')->insert([
            'name' => 'テスト日本人',
            'email' => 'test@test',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '0',
            'is_japanese' => '1',
            'hobby_category_id' => '1',
        ]);
        // 日本人
        DB::table('users')->insert([
            'name' => '田中さくら',
            'email' => 'tanaka@sakura',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '28',
            'is_japanese' => '1',
            'hobby_category_id' => '1',
            'comment' => '最近はカフェ巡りが趣味で、神奈川の海沿いのカフェがお気に入りです。',
        ]);
        DB::table('users')->insert([
            'name' => '山田太郎',
            'email' => 'yamada@taro',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '35',
            'is_japanese' => '1',
            'hobby_category_id' => '2',
            'comment' => '仕事が忙しい日々ですが、週末には京都で歴史を感じながら散歩するのが癒しです。'
        ]);
        DB::table('users')->insert([
            'name' => '伊藤悠美',
            'email' => 'ito@yumi',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '24',
            'is_japanese' => '1',
            'hobby_category_id' => '3',
            'comment' => '北海道の良いところ案内できます。'
        ]);
        DB::table('users')->insert([
            'name' => '渡辺健太',
            'email' => 'watanabe@kenta',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '31',
            'is_japanese' => '1',
            'hobby_category_id' => '1',
            'comment' => '九州の美味しいものを求めて、週末には佐賀までドライブに行くことがよくあります。'
        ]);
        DB::table('users')->insert([
            'name' => '中村美咲',
            'email' => 'nakamura@misaki',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '22',
            'is_japanese' => '1',
            'hobby_category_id' => '2',
            'comment' => '京都の伝統と文化が大好きです。琵琶湖も好きです。'
        ]);
        
        // 外国人
        DB::table('users')->insert([
            'name' => 'Emily Davis',
            'email' => 'emily@davis',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '30',
            'is_japanese' => '0',
            'hobby_category_id' => '1',
            'comment' => '日本の伝統的なお寺や神社を巡りながら、美しい桜を楽しむのが楽しみです。'
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Rodriguez',
            'email' => 'juan@rodriguez',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '25',
            'is_japanese' => '0',
            'hobby_category_id' => '2',
            'comment' => '日本の先進的なテクノロジーとアートに触れるのが楽しみです。'
        ]);
        DB::table('users')->insert([
            'name' => 'Aya Khan',
            'email' => 'aya@khan',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '28',
            'is_japanese' => '0',
            'hobby_category_id' => '3',
            'comment' => 'お好み焼きが楽しみです。'
        ]);
        DB::table('users')->insert([
            'name' => 'Luca Ferrari',
            'email' => 'luca@ferrari',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '0',
            'age' => '35',
            'is_japanese' => '0',
            'hobby_category_id' => '1',
            'comment' => '北海道の雪まつりは写真で見たことがあり、実際に体験するのが楽しみです。'
        ]);
        DB::table('users')->insert([
            'name' => 'Mei Chen',
            'email' => 'mei@chen',
            'password' => '$2y$10$hiMW/YNmlxawhpcKP6FkEO/zAYndpZ1ljDOQ/NUzcTuOgD25WL4ry',
            'gender_flag' => '1',
            'age' => '22',
            'is_japanese' => '0',
            'hobby_category_id' => '2',
            'comment' => '日本の伝統的な神社やお祭りに参加するのが楽しみです。'
        ]);
    }
}
