<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $fillable = [
        'ordinal',
        'codprod',
        'desprod',
        'quanty',
        'admission_id'
    ];

    public function admission(){
        return $this->belongsTo(Admission::class);
    }
}
