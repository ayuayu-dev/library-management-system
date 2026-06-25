<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            '未分類',          // id = 1（超重要！）
            '小説',
            'ミステリー',
            'SF',
            'ビジネス',
            '自己啓発',
            'IT・プログラミング',
            '科学・自然',
            '歴史',
            '料理',
            'アート・デザイン',
            '児童書',
            'コミック',
            'その他',
        ];

        foreach ($categories as $index => $name) {
            Category::create([
                'id'   => $index + 1,
                'name' => $name,
            ]);
        }
    }
}
