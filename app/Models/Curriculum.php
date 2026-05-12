<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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


    /**
     * 指定した学年と年月でカリキュラムを絞り込むスコープ
     */
    public function scopeForSelectedGrade(Builder $query, int $selectedGrade, Carbon $targetDate)
    {
        return $query->where('grade_id', $selectedGrade)
            ->where(function ($q) use ($targetDate) {
                // 1. 常時公開フラグが 1 のもの
                $q->where('alway_delivery_flg', 1)
                    // 2. または、配信期間が指定の年月と一致するもの
                    ->orWhereHas('deliveryTimes', function ($subQ) use ($targetDate) {
                        $subQ->whereYear('delivery_from', $targetDate->year)
                            ->whereMonth('delivery_from', $targetDate->month);
                    });
            })
            ->leftJoin('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculums_id')
            ->select('curriculums.*', DB::raw('MIN(delivery_times.delivery_from) as first_delivery'))
            ->groupBy('curriculums.id')
            ->orderByRaw('CASE WHEN alway_delivery_flg = 1 THEN 0 ELSE 1 END')
            ->orderBy('first_delivery', 'asc');
    }
}
