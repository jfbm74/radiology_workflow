<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
