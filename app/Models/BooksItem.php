<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksItem extends Model
{
    protected $table = 'books_items';
    
    protected $fillable = [
        'status',
        'item_number',
        'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class, 'books_item_id');
    }
}
