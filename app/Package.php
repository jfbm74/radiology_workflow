<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function packagedetail(){
        return $this->hasMany(PackageDetail::class);
    }
}
