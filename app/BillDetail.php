<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BillDetail extends Model
{
    protected $fillable = [
        'ordinal',
        'codprod',
        'desprod',
        'quanty',
        'admission_id'
    ];

//    =============================SCOPES=======================
    /**
     * Function that returns a JSOM product quantity by month
     * @param $query
     * @return mixed
     */
    public function scopeQuantyPackagesByMonth($query, $date_ini, $date_end)
    {
        return DB::
        table('bill_details')
            ->select(
                DB::raw('count(*) as product_count'),
                'products.cod_manager'
            )
            ->join('admissions', 'bill_details.admission_id', '=', 'admissions.id')
            ->join('products', 'bill_details.codprod', '=', 'products.cod_manager')
            ->whereBetween('admissions.invoice_date', [$date_ini, $date_end])
            ->where('products.is_package', '=', '1')
            ->groupBy('products.cod_manager')
            ->orderBy('product_count', 'DESC')
            ->get();
    }


//    ========================RELATIONSHIPS=====================
    public function admission(){
        return $this->belongsTo(Admission::class);
    }
}
