<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $guarded = [];

    public function userFind()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }
}
