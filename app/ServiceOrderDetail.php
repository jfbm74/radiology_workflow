<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceOrderDetail extends Model
{
    protected $fillable = [
        'service_order_id',
        'ordinal',
        'cod_manager',
        'name',
        'status',
        'fullfilment_date',
        'exposure_time',
        'ionizing_radiation_dose',
        'user_id'
    ];

//    =======================Scopes===========================
    /**
     * Function that returns list of patients and their dosimetry
     * @param $query
     * @return mixed
     */
    public function scopeDosimetryByDate($query, $date_ini, $date_end){

        $data = ServiceOrderDetail::whereBetween('fullfilment_date', [$date_ini, $date_end])->get();
        return $query = $data;
    }

    /**
     * Function that returns a list of orders given a date
     * @param $query
     * @return mixed
     */
    public function scopeQuantyOrders($query, $date_ini, $date_end)
    {
//        $data = DB::table('service_order_details')->
//        whereBetween('created_at', [$date_ini, $date_end]);
//        $query =$data;
//        return $query;

        return DB::
        table('service_order_details')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.id', '=', 'admissions.id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->orderBy('admissions.invoice_date', 'DESC')
            ->get();
    }

    /**
     * Function that returns a list of orders given a date
     * grouped by month
     * @param $query
     * @return mixed
     */
    public function scopeQuantyOrdersByMonth($query, $date_ini, $date_end)
    {
        return DB::
            table('service_order_details')
            ->select(
                DB::raw('count(*) as id_count'),
                DB::Raw("DATE_FORMAT(admissions.invoice_date, '%Y-%m') new_date" ),
                //DB::Raw('YEAR(admissions.invoice_date) year, month(admissions.invoice_date) month' ),
            )
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.id', '=', 'admissions.id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->groupBy('new_date')
            ->orderBy('new_date', 'ASC')
            ->get();
    }


//    =================Relationships==========================
    public function serviceorder()
    {
        return $this->belongsTo(ServiceOrder::class, 'service_order_id');
    }

    public function printing(){
        return $this->hasMany(Printing::class, 'service_order_details_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
