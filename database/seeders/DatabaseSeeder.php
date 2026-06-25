<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 初期カテゴリ（← 先に！）
        $this->call(CategorySeeder::class);

        // 会員データ
        $this->call(MembersSeeder::class);

        // 書籍データ
        $this->call(BooksSeeder::class);

        // 冊子データ
        $this->call(BooksItemsSeeder::class);
    }
}
