<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    // ユーザーとのリレーション（1つの学年にはたくさんのユーザーがいる）
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
