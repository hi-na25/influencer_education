<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $table = 'delivery_times'; 

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

}
