<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    // 今回のテーブル名は 'articles' なので、それを明示します
    protected $table = 'articles';

    protected $casts = [
        'posted_date' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];
}
