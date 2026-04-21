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
    

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id', 'id');
    }

    public function curriculumProgress()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id', 'id');
    }
}