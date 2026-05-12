<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // 今回のテーブル名は 'articles' なので、それを明示します
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];

    protected $casts = [
        'posted_date' => 'datetime',
    ];

    // もし主キー（id）以外の名前を使っている場合は必要ですが、今回は id なので不要です
}

