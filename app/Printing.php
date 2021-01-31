<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function serviceorderdetail()
    {
        return $this->belongsTo(ServiceOrderDetail::class, 'service_order_details_id');
    }
}
