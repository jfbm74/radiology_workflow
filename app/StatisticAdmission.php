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


    /**=================RELATIONSHIPS=====================*/
    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**=================SCOPES=====================*/
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

    /**
     * Function that returns a collection patients given date range
     * @param $query
     * @param $date_ini initial range date
     * @param $date_end final range date*
     * @return mixed
     */
    public function scopeOpportunity($query, $date_ini, $date_end){

        $data = StatisticAdmission::whereBetween('admission_date', [$date_ini, $date_end])->get();
        return $query = $data;
    }


    /**
     * Function that returns a collection patients given date range and technich
     * @param $query
     * @param $date_ini initial range date
     * @param $date_end final range date
     * @param $id Technician Id User
     * @return mixed
     */
    public function scopeTechnicianOpportunity($query, $date_ini, $date_end, $id){

        $data = StatisticAdmission::whereBetween('admission_date', [$date_ini, $date_end])
                                    ->where('user_id', $id)->get();
        return $query = $data;
    }


}
