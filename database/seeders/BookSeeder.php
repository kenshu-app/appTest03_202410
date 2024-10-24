<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Book;

class BookSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('ja_JP');
        $numBook = 50;
        $numUser = 3;
        $bookTitle = [
            '気づけばプロ並みPHP',
            '独習PHP',
            'よくわかるPHPの教科書',
            'PHP2026年1月号人生、笑うが勝ち!',
            'レベルアップPHP',
            'PHPふりがなプログラミング',
            '基礎からのMySQL',
            '詳解MySQL Database入門',
            '15時間でわかるMySQL集中講座',
            '3ステップでしっかり学ぶMySQL入門',
            'MySQL徹底入門',
            'Web開発のためのMySQL超入門',
            'PHPフレームワークLaravel入門',
            'PHPフレームワークLaravel実践開発',
            'Laravel速習シリーズ',
            'PHPフレームワークLaravelWebアプリケーション開発',
            'Laravelエキスパート養成読本',
            '紙とえんぴつで学ぶアルゴリズムとフローチャート',
            '作りながら学ぶ Webシステムの教科書',
            '基礎から学ぶLaravel',
            'Laravelの教科書',
            '動かして学ぶ！Laravel開発入門',
            'GitHub Actionsでデプロイ！Laravel編'
        ];
        $bookPublisher = [
            '集英社',
            'KADOKAWA',
            '小学館',
            '岩波書店',
            '講談社',
            '新潮社',
            '筑摩書房',
            '平凡社',
            '光文社',
            '中央公論社',
            '朝日新聞社',
            'みすず書房',
            '学研ホールディングス',
            'インプレスホールディングス'
        ];
        for ($i = 0; $i < $numBook; $i++) {
            Book::create([
                'title'      => $bookTitle[mt_rand(0, array_key_last($bookTitle))],
                'user_id'    => mt_rand(1, $numUser),
                'author'     => $faker->name(),
                'publisher'  => $bookPublisher[mt_rand(0, array_key_last($bookPublisher))],
                'review'     => $faker->realText(50),
                'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
                'updated_at' => $faker->dateTime('now'),
            ]);
        }
    }
}
