<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'legal_id',
        'birthday',
        'email'
    ];

    public function admission()
    {
        return $this->hasMany(Admission::class)->orderBy('invoice_date', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
