<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $fillable = [
        'admission_id',
        'user_id',
        'is_active'
    ];


    public function admission(){
        return $this->belongsTo(Admission::class);
    }

    public function serviceorderdetail()
    {
        return $this->hasMany(ServiceOrderDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
