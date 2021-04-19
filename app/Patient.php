<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'legal_id',
        'phone',
        'birthday',
        'email'
    ];

//    ======================SCOPES ============================


//    ======================RELATIONSHIPS ============================
    public function admission()
    {
        return $this->hasMany(Admission::class)->orderBy('invoice_date', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
