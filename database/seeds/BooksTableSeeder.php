<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
          'name' => 'おうちで学べるプログラミングのきほん',
          'author' => '河村進',
          'score' => 3,
          'comment' => '内容は基本的だが、これが分かっていないとその後の学習が捗らない。',
          'user_id' => 1,
        ];
        DB::table('books')->insert($param);

        $param = [
          'name' => 'Webを支える技術',
          'author' => '山本陽平',
          'score' => 4,
          'comment' => 'HTML,URI,HTTPなど普段何気なく使用している用語の本質的な解説。歴史的背景を踏まえて解説されており、ストーリーとして理解できる。',
          'user_id' => 1,
        ];
        DB::table('books')->insert($param);

        $param = [
          'name' => 'PHPフレームワーク Laravel入門 第2版',
          'author' => '掌田津耶乃',
          'score' => 4,
          'comment' => 'laravelの基本から解説されており、初心者向け。逆に、上級書からすると物足りないかもしれない',
          'user_id' => 1,
        ];
        DB::table('books')->insert($param);
    }
}
