<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BooksSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('books.csv');

        if (!File::exists($path)) {
            $this->command->error('books.csv が見つかりません');
            return;
        }

        $file = fopen($path, 'r');

        // ヘッダ行を取得
        $header = fgetcsv($file);

        $limit = 10000;   // ← ★ここで件数制限
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {

            // 1万件に達したら終了
            if ($count >= $limit) {
                break;
            }

            $data = array_combine($header, $row);

            // 必須項目チェック（安全ガード）
            if (empty($data['title']) || empty($data['creator'])) {
                continue;
            }

            DB::table('books')->insert([
                'title'       => $data['title'],
                'author'      => $data['creator'],
                'publisher'   => $data['publisher'] ?: null,
                'isbn'        => null,
                'category_id' => 1, // 未分類
                'description' => $data['note'] ?: null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            $count++;
        }

        fclose($file);

        // 結果表示（これ超便利✨）
        $this->command->info("BooksSeeder: {$count} 件のデータを登録しました！");
    }
}
