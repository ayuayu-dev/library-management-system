<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'member_id',
        'books_item_id',
        'action_type',
        'action_date',
        'due_date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function booksItem()
    {
        return $this->belongsTo(BooksItem::class, 'books_item_id');
    }
}
