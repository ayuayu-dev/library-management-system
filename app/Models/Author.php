<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'bio',
    ];

    // 本（Book）とのリレーション
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
