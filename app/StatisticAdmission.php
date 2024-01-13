<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function serviceorder()
    {
        return $this->hasOne(ServiceOrder::class, 'admission_id');
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
     * Function that returns opportunity average given date
     * @param $query
     * @return mixed
     */
    public function scopeOpportunityAverage($query, $date_ini, $date_end)
    {
        $data = DB::table('statistic_admissions')->
        whereBetween('admission_date', [$date_ini, $date_end])
            ->avg('attention_time');
        $query =$data;
        return $query;
    }

    /**
     * Function that returns an average opportunity cumulative by month
     * grouped by month
     * @param $query
     * @return mixed
     */
    public function scopeOpportunityOrdersByMonth($query, $date_ini, $date_end)
    {
        return DB::
        table('statistic_admissions')
            ->select(
                DB::raw('avg(attention_time) as avg_month'),
                DB::Raw("DATE_FORMAT(admission_date, '%Y-%m') month" )
            )
            ->whereBetween('admission_date', [$date_ini, $date_end])
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();
    }


    /**
     * Function that returns a collection patients given date range and technician
     * @param $query
     * @param $date_ini initial range date
     * @param $date_end final range date
     * @param $id Technician Id User
     * @return mixed
     */
/*      public function scopeTechnicianOpportunity($query, $date_ini, $date_end, $id){
        
        $data = StatisticAdmission::
            whereBetween('admission_date', [$date_ini, $date_end])
            //->where('user_id', $id)
            ->get();
        return $query = $data;
    }  */


     public function scopeTechnicianOpportunity($query, $date_ini, $date_end) {
        return $query->select('statistic_admissions.*')
            ->leftJoin('admissions', 'statistic_admissions.admission_id', '=', 'admissions.id')
            ->leftJoin('service_orders', 'admissions.id', '=', 'service_orders.admission_id')
            ->leftJoin('service_order_details', 'service_orders.id', '=', 'service_order_details.service_order_id')
            ->whereBetween('admissions.created_at', [$date_ini, Carbon::parse($this->date2)->endOfDay()])
            ->groupBy('statistic_admissions.id')
            ->selectRaw('COUNT(service_order_details.id) as order_count');
    } 




}
