<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory; // HasFactoryはテストデータ作成などで使う便利な機能

    protected $table = 'curriculums'; 

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    
}