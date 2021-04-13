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
