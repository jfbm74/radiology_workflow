<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{

//    ======================>Relationships<================
    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
