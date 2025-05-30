<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'path', 'type']; // Разрешаем массовое заполнение

    public function post()
    {
        return $this->belongsTo(Post::class); // Указываем связь с Post
    }
}

