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

////    =================================SCOPES============================
//    /**
//     * Function that returns a collection patients given date range
//     * @param $query
//     * @param $date_ini initial range date
//     * @param $date_end final range date*
//     * @return mixed
//     */
//    public function scopeProductivityDetail($query, $date_ini, $date_end){
//
//        $data = Printing::whereBetween('created_at', [$date_ini, $date_end])->
//                        where('is_printed', 1)->get();
//        return $query = $data;
//    }


//    /**
//     * Function that returns a JSON orders given two dates
//     * @param $query
//     * @return mixed
//     */
//    public function scopeQuantyOrders($query, $date_ini, $date_end)
//    {
//
//        return DB::
//        table('printings')
//            ->select('*' )
//            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
//            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
//            ->join('admissions', 'service_orders.id', '=', 'admissions.id')
//            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
//            ->get();
//    }

//
//    /**
//     * Function that returns a number of orders cumulative by month given two dates
//     * grouped by month
//     * @param $query
//     * @return mixed
//     */
//    public function scopeQuantyOrdersByMonth($query, $date_ini, $date_end)
//    {
//        return DB::
//        table('printings')
//            ->select(
//                DB::raw('count(*) as id_count'),
//                DB::Raw("DATE_FORMAT(admissions.invoice_date, '%Y-%m') new_date" ),
//            //DB::Raw('YEAR(admissions.invoice_date) year, month(admissions.invoice_date) month' ),
//            )
//            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
//            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
//            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
//            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
//            ->groupBy('new_date')
//            ->orderBy('new_date', 'ASC')
//            ->get();
//    }

//    /**
//     * Function that returns a JSON format with number of orders grouped by product given tow dates
//     * grouped by month
//     * @param $query
//     * @return mixed
//     */
//    public function scopeQuantyProductsByDate($query, $date_ini, $date_end)
//    {
//        return DB::
//        table('service_order_details')
//            ->select(
//                DB::raw('count(*) as id_count'),
//                DB::Raw("DATE_FORMAT(admissions.invoice_date, '%Y-%m') new_date" ),
//            //DB::Raw('YEAR(admissions.invoice_date) year, month(admissions.invoice_date) month' ),
//            )
//            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
//            ->join('admissions', 'service_orders.id', '=', 'admissions.id')
//            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
//            ->groupBy('new_date')
//            ->orderBy('new_date', 'ASC')
//            ->get();
//    }

//    /**
//     * Function that returns a JSOM format with number of orders by professional
//     * @param $query
//     * @return mixed
//     */
//    public function scopeQuantyOrdersProfessionalByMonth($query, $date_ini, $date_end)
//    {
//        return DB::
//        table('printings')
//            ->select(
//                DB::raw('count(*) as product_count'),
//                'users.name'
//            )
//            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
//            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
//            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
//            ->join('users', 'users.id', '=', 'admissions.user_id')
//            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
//            ->groupBy('users.name')
//            ->orderBy('product_count', 'DESC')
//            ->get();
//    }

//    /**
//     * Function that returns a JSOM product quantity by month
//     * @param $query
//     * @return mixed
//     */
//    public function scopeOrdersTechnicianByMonth($query, $date_ini, $date_end)
//    {
//        return DB::
//        table('printings')
//            ->select(
//                DB::raw('count(*) as product_count'),
//                'users..name'
//            )
//            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
//            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
//            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
//            ->join('users', 'users.id', '=', 'printings.user_id')
//            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
//            ->where('printings.is_printed', '=', '1')
//            ->groupBy('users.name')
//            ->orderBy('product_count', 'DESC')
//            ->get();
//    }

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
