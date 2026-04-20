<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumClearCheck extends Model
{
    use HasFactory;

    protected $table = 'classes_clear_checks'; 

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

}
