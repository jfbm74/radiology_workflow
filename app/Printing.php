<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
