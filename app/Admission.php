<?php

namespace App;

use App\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = [
        
        'doctype',
        'invoice_number',
        'invoice_date',
        'user_id',
        'patient_id',
        'status',
        'priority',
        'obs', 
        'delivery'
    ];

    public function scopeActivated($query){
        return $query = Admission::where('status', 'En Espera')
                        ->orderBy('priority', 'asc')
                        ->orderBy('invoice_date', 'asc');                        
    }

    public function scopeDailytotal($query){
        return $query = Admission::whereDate('created_at', Carbon::today());
    }

    public function scopeAttending($query){
        return $query = Admission::where('status', 'En Atención')
                        ->orderBy('priority', 'asc')
                        ->orderBy('invoice_date', 'asc');       
    }

    public function scopePendding($query){
        return $query = Admission::where('status', 'Pendiente')
                        ->orderBy('invoice_date', 'asc');       
    }

    /**
     * Get the Patient record associated with the Admission.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billdetail()
    {
        return $this->hasMany(BillDetail::class);
    }

    public function serviceorder()
    {
        return $this->hasOne(ServiceOrder::class);
    }

    public function photos(){
        return $this->hasMany(Photos::class);
    }

    public function statisticadmission()
    {
        return $this->belongsTo(StatisticAdmission::class);
    }
    
}
