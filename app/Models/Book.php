<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BooksItem;

class Book extends Model
{
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
        return $this->belongsTo(Author::class);
    }

    // カテゴリ
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 冊子（books_items）
    public function booksItems()
    {
        return $this->hasMany(BooksItem::class);
    }
}
