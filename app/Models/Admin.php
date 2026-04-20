<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // ←ここがポイント！
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // テーブル名を明示
    protected $table = 'admins';

    // ログインなどで使う情報（ER図にあるカラムに合わせて）
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // パスワードなどは隠しておく設定
    protected $hidden = [
        'password',
    ];
    
}

