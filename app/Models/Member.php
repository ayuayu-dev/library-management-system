<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function actions()
    {
        return $this->hasMany(Action::class);
    }
}
