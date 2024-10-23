<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'publisher', 'review'];

    public function user()
    {
        // 書籍はユーザに属している
        return $this->belongsTo(User::class);
    }
}
