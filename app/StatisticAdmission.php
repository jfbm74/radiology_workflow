<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticAdmission extends Model
{
    protected $fillable = [
        'admission_id',
        'admission_date',
        'waiting_time',
        'attention_time',
        'finish_time',
        'user_id',
        'professional_id',
    ];
}
