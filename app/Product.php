<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'cod_manager',
        'name',
        'radiation_dose_type',
        'station',
        'is_package',
        'is_active',
    ];
}
