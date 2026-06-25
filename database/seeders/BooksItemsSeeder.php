<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\BooksItem;
use Illuminate\Support\Str;

class BooksItemsSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ 大量データ対策：処理する本の上限
        $books = Book::orderBy('id', 'desc')
            ->limit(1000)
            ->get();

        foreach ($books as $book) {
            // 1冊につき 1〜5 冊の冊子を生成
            $count = rand(1, 5);

            for ($i = 0; $i < $count; $i++) {
                BooksItem::create([
                    'book_id' => $book->id,
                    'item_number' => Str::uuid(),
                    'status' => $this->randomStatus(),
                ]);
            }
        }
    }

    private function randomStatus(): string
    {
        return collect([
            'available',
            'available',
            'available',
            'loaned',
            'available',
            'damaged',
            'lost',
        ])->random();
    }
}
