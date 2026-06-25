<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\BooksItem;
use App\Models\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Services\ItemNumberGenerator;

class RebuildBooksItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // 🔓 外部キー制約を一時的にOFF
            Schema::disableForeignKeyConstraints();

            // ① 履歴は全削除
            Action::truncate();

            // ② 冊子データを全削除
            BooksItem::truncate();

            // 🔒 外部キー制約をONに戻す
            Schema::enableForeignKeyConstraints();

            // ③ books から冊子を再生成
            Book::chunk(500, function ($books) {
                foreach ($books as $book) {

                    $count = max(1, (int) ($book->start_stock ?? 1));

                    for ($i = 1; $i <= $count; $i++) {
                        BooksItem::create([
                            'book_id'     => $book->id,
                            //'item_number' => $this->generateItemNumber($book->id, $i),
                            'item_number' => ItemNumberGenerator::generate($book->id, $i),
                            'status'      => 'available',
                        ]);
                    }
                }
            });
        });
    }

    private function generateItemNumber(int $bookId, int $index): string
    {
        return sprintf(
            'LIB-%06d-%02d',
            $bookId,
            $index
        );
    }
}
