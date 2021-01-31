<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOrderDetail extends Model
{
    protected $fillable = [
        'service_order_id',
        'ordinal',
        'name',
        'status',
        'fullfilment:date',
        'user_id'
    ];

    public function serviceorder()
    {
        return $this->belongsTo(ServiceOrder::class, 'service_order_id');
    }

    public function printing(){
        return $this->hasMany(Printing::class, 'service_order_details_id');
    }
}
