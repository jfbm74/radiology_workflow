<?php

namespace App;

use App\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admission extends Model
{
    protected $fillable = [

        'doctype',
        'docclase',
        'invoice_number',
        'invoice_date',
        'user_id',
        'patient_id',
        'status',
        'priority',
        'obs',
        'delivery',
        'order_printing'
    ];


//    ===============================SCOPES===========================================
    /**
     * Function that returns a list of patients given a date
     * @param $query
     * @return mixed
     */
    public function scopePatients($query, $date_ini, $date_end)
    {
        $data = DB::table('admissions')->
            whereBetween('invoice_date', [$date_ini, $date_end]);
        $query =$data;
        return $query;
    }

    /**
     * Function that returns a list of patients with Virtual Delivery
     * for staff users
     * @param $query
     * @return mixed
     */
    public function scopePortalPatientsForStaff($query)
    {
        return Admission::where('status', 'Finalizado')
            ->where(function ($query){
                $query->where('delivery', 'Virtual')
                    ->orWhere('delivery', 'Ambas');
            })
            ->orderBy('invoice_date', 'DESC');
    }


    /**
     * Function that returns a list of patients with Virtual Delivery
     * for specific professional
     * @param $query
     * @return mixed
     */
    public function scopeGetVirtualPatientsByPro($query, $id)
    {
        return Admission::where('status', 'Finalizado')
            ->where('user_id', $id)
            ->where(function ($query){
                $query->where('delivery', 'Virtual')
                    ->orWhere('delivery', 'Ambas');
            })
            ->orderBy('invoice_date', 'DESC');
    }



    /**
     * Functions that returns a admissions  collection that have status Active
     * @param $query
     * @return  Collection of admission with status active
     */
    public function scopeActivated($query){
        return $query = Admission::where('status', 'En Espera')
                        ->orderBy('priority', 'asc')
                        ->orderBy('invoice_date', 'asc');
    }


    /**
     * Functions that returns all admission for today
     * @param $query
     * @return mixed
     */
    public function scopeDailytotal($query){
        return $query = Admission::whereDate('created_at', Carbon::today());
    }


    /**
     * Function that returns the patients (admission) that have been attending in a given moment
     * @param $query
     * @return mixed
     */
    public function scopeAttending($query){
        return $query = Admission::where('status', 'En Atención')
                        ->orderBy('priority', 'asc')
                        ->orderBy('invoice_date', 'asc');
    }


    /**
     * Function that returns a collection for admission with pending service orders
     * @param $query
     * @return mixed
     */
    public function scopePendding($query){
        return $query = Admission::where('status', 'Pendiente')
                        ->orderBy('invoice_date', 'asc');
    }

    /**
     * Function that returns a collection for admission with pending service orders
     * older than 24 hours
     * @param $query
     * @return mixed
     */
    public function scopePendingOlders($query){
        return $query = Admission::where('status', 'Pendiente')
            ->whereDate('invoice_date', '<', Carbon::yesterday())
            ->orderBy('invoice_date', 'asc');
    }


    /**
     * ======================relationships=================================
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
        return $this->hasOne(StatisticAdmission::class);
    }

}
