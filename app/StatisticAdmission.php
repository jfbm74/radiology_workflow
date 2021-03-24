<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StatisticAdmission extends Model
{
    protected $fillable = [
        'admission_id',
        'admission_date',
        'waiting_time',
        'attention_time',
        'finish_time',
        'user_id',
        'professional_id',
    ];

    /**
     * Function that returns average attending time for today's admissions
     * @param $query
     * @return mixed
     */
    public function scopeAverageTimeAttending($query){
        $posts = StatisticAdmission::whereDate('admission_date', Carbon::today())->get();
        $average_time = $posts->avg('attention_time');
        return $query = $average_time;
    }
}
