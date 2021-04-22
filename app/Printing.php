<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\DB;

class Printing extends Model
{
    protected $fillable = [
        'service_order_details_id',
        'ordinal',
        'type',
        'quanty',
        'is_printed',
        'printed_date',
        'user_id'
    ];

//    =================================SCOPES============================
    /**
     * Function that returns a collection patients given date range
     * @param $query
     * @param $date_ini initial range date
     * @param $date_end final range date*
     * @return mixed
     */
    public function scopeProductivityDetail($query, $date_ini, $date_end){

        $data = Printing::whereBetween('created_at', [$date_ini, $date_end])->
                        where('is_printed', 1)->get();
        return $query = $data;
    }


    /**
     * Function that returns a JSOM product quantity by month
     * @param $query
     * @return mixed
     */
    public function scopeQuantyProductsByMonth($query, $date_ini, $date_end)
    {
        return DB::
        table('printings')
            ->select(
                DB::raw('count(*) as product_count'),
                'products.name'
            )
            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
            ->join('products', 'service_order_details.product_id', '=', 'products.id')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->groupBy('products.name')
            ->orderBy('product_count', 'DESC')
            ->get();
    }

    /**
     * Function that returns a JSOM product quantity by month
     * @param $query
     * @return mixed
     */
    public function scopeQuantyOrdersProfessionalByMonth($query, $date_ini, $date_end)
    {
        return DB::
        table('printings')
            ->select(
                DB::raw('count(*) as product_count'),
                'users.name'
            )
            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
            ->join('users', 'users.id', '=', 'admissions.user_id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->groupBy('users.name')
            ->orderBy('product_count', 'DESC')
            ->get();
    }

    /**
     * Function that returns a JSOM product quantity by month
     * @param $query
     * @return mixed
     */
    public function scopeOrdersTechnicianByMonth($query, $date_ini, $date_end)
    {
        return DB::
        table('printings')
            ->select(
                DB::raw('count(*) as product_count'),
                'users..name'
            )
            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
            ->join('users', 'users.id', '=', 'printings.user_id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->where('printings.is_printed', '=', '1')
            ->groupBy('users.name')
            ->orderBy('product_count', 'DESC')
            ->get();
    }

//    ==============================RELATIONSHIPS======================
    public function serviceorderdetail()
    {
        return $this->belongsTo(ServiceOrderDetail::class, 'service_order_details_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
