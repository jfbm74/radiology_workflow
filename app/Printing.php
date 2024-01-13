<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
///
///
    /**
     * Function that returns a collection patients given date range
     * @param $query
     * @param $date_ini initial range date
     * @param $date_end final range date*
     * @return mixed
     */
    public function scopePaquete($query, $date_ini, $date_end)
    {
        return DB::
        table('bill_details')
            ->select('*')
            ->whereBetween('bill_details.created_at', [$date_ini, $date_end])
            ->get();
    }
    /**
     * Function that returns a collection patients given date range
     * @param $query
     * @param $date_ini initial range date
     * @param $date_end final range date*
     * @return mixed
     */   
    public function scopeProductivityDetail($query, $date_ini, $date_end)
    {
        return  DB::table('printings')
        ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
        ->join('service_orders', 'service_orders.id', '=', 'service_order_details.service_order_id')
        ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
        ->join('patients', 'admissions.patient_id', '=', 'patients.id')
        ->join('users as PRO', 'admissions.user_id', '=', 'PRO.id')
        ->join('users as TEC', 'printings.user_id', '=', 'TEC.id')
        ->join('products', 'service_order_details.product_id', '=', 'products.id')
        ->join('statistic_admissions', 'statistic_admissions.admission_id', '=', 'admissions.id')
        ->select(
            'printings.*', 
            'service_order_details.*', 
            'service_orders.*', 
            'admissions.invoice_date', 
            'admissions.doctype', 
            'admissions.order_printing', 
            'admissions.invoice_number', 
            'patients.name as PatientName', 
            'patients.legal_id', 
            'patients.birthday', 
            'products.cod_manager', 
            'products.name as ProductName', 
            'PRO.name as ProfessionalName', 
            'TEC.name as TechnicianName', 
            'statistic_admissions.attention_time'
        )
        ->whereBetween('admissions.invoice_date', [$date_ini, Carbon::parse($this->date2)->endOfDay()])
        ->get();     
    }

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


    /**
     * Function that returns a number of orders cumulative by month given two dates
     * grouped by month
     * @param $query
     * @return mixed
     */
    public function scopeQuantyOrdersByDate($query, $date_ini, $date_end)
    {
        return DB::
        table('printings')
            ->select(
                DB::raw('count(*) as id_count'),
                DB::Raw("DATE_FORMAT(admissions.invoice_date, '%Y-%m') new_date" )
            //DB::Raw('YEAR(admissions.invoice_date) year, month(admissions.invoice_date) month' )
            )
            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->groupBy('new_date')
            ->orderBy('new_date', 'ASC')
            ->get();
    }

    /**
     * Function that returns a JSON format with number of orders grouped by product given tow dates
     * grouped by month
     * @param $query
     * @param $date_ini
     * @param $date_end
     * @return mixed
     */

    public function scopeQuantyProductsByDate($query, $date_ini, $date_end)
    {
        return DB::
        table('printings')
            ->select(
                DB::raw('count(*) as id_count'),
                'products.name'

            )
            ->join('service_order_details', 'service_order_details.id', '=', 'printings.service_order_details_id')
            ->join('service_orders', 'service_order_details.service_order_id', '=', 'service_orders.id')
            ->join('admissions', 'service_orders.admission_id', '=', 'admissions.id')
            ->join('products', 'products.id', '=', 'service_order_details.product_id')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->groupBy('products.name')
            ->orderBy('id_count', 'DESC')
            ->get();
    }

    /**
     * Function that returns a JSOM format with number of orders by professional
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
