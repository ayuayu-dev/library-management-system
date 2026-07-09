<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BooksItem;

class Book extends Model
{
    //登録処理や更新処理で保存する必要がある項目を定義する
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'published_year',
        'category_id',
        'description',
        'start_stock',
    ];

    // 著者
    public function author()
    {
        //booksテーブルとAuthorテーブルを紐付け（booksテーブルのauthor_idで紐付け）
        return $this->belongsTo(Author::class);
    }

    // カテゴリ
    public function category()
    {
        //booksテーブルとcategoryテーブルを紐付け（booksテーブルのcategory_idで紐付け）
        return $this->belongsTo(Category::class);
    }

    // 冊子（books_items）
    public function booksItems()
    {
        //booksテーブルはbooks_itemsテーブルと関連性あり
        //booksテーブル（1）：books_itemsテーブル（N）の関連性を定義する
        return $this->hasMany(BooksItem::class);
    }
}
