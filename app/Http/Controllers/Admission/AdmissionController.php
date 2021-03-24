<?php

namespace App\Http\Controllers\Admission;

use App\User;

use App\Patient;
use App\Admission;
use App\BillDetail;
use App\StatisticAdmission;
use Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\AdmissionWasDeleted;
use App\Http\Controllers\Controller;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $admissions = Admission::activated()->get();
        $waiting_room = Admission::activated()->get()->count();
        $today_patients = Admission::dailytotal()->get()->count();
        $penddings = Admission::pendding()->get()->count();
        $in_progress = Admission::attending()->get()->count();
        $time_to_attend = StatisticAdmission::AverageTimeAttending();

        return view('admission.index',
                        compact(    'admissions',
                                    'waiting_room',
                                    'today_patients',
                                    'penddings',
                                    'in_progress',
                                    'time_to_attend'
                        ));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Saving Patient
        $patient = new Patient;
        $patient = app()->call('App\Http\Controllers\Admission\PatientController@store', ['request' => $request]);

        //Save Admission
         if ( $request->priority == "1") {
            $request->priority ='1';
         }
         else{
            $request->priority = '5';
         }

        $admission = Admission::where('invoice_number', $request->docnumero )->get();
        if ($admission) {

            $admission = new Admission;
            $admission =Admission::firstOrCreate([
                'invoice_number' => $request->docnumero,
                'invoice_date' => $request->invoice_date,
                'user_id' => $request->docvende,
                'patient_id' =>  $patient->id,
                'priority' => $request->priority,
                'delivery' => $request->option,
                'obs' => $request->observations,
                'doctype' => $request->doctipo,
                'docclase' => $request->docclase,
            ]);

            //Save Bill Details ( ordinal, codprod, desprod, patient_id, bill_id )
            foreach ($request->details as $key => $detail) {
                if ($detail['codprod'] != '.') {
                    $billdetail = BillDetail::firstOrCreate([
                            'ordinal' => $key+1,
                            'codprod' => $detail['codprod'],
                            'desprod' => $detail['nomprod'],
                            'quanty'  => $detail['quanty'],
                            'admission_id' => $admission->id
                    ]);
                }
                else{continue;}
            };
        }

        //Save User
        $user = app()->call('App\Http\Controllers\Admin\UserController@store', ['id' => $request->docvende]);
        $user->patient()->attach($patient);

        //Admission Stats

        //returning admission.index view
        return redirect()->route('admission.index')->with('flash', 'Ingreso guardado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $admission)
    {

        return view("admission.edit", compact('admission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {


        $from_module = $request->server('REQUEST_URI');


        $patient = Patient::where('legal_id', $request->patient_id)->first();
        $request->name = Str::upper($request->name);
        $patient->name = $request->name;
        $patient->birthday = $request->birthday;
        $patient->save();

        //Save Patient_User RelationShip
        if ($request->user_id) {
            $user = User::where('id',  $request->user_id)->first();
            $admission->user_id = $request->user_id;

            $validate = DB::table('patient_user')->where('user_id' , $user->id)->where('patient_id', $patient->id)->first();
            if (!$validate) {
                $user->patient()->attach($patient);
            }
        }
        if ( $request->priority == "on") {
            $request->priority ='1';
         }
         else{
            $request->priority = '5';
         }

        //Updating Admission
        $admission->priority = $request->priority;
        $admission->delivery = $request->option;
        $admission->obs = $request->observations;
        $admission->save();

        //Auditing Update Classes


        //Returning to requested url
        if ( $from_module ) {
            return redirect()->route('admission.index')->with('flash', 'Ingreso Actualizado');
        } else {
            return redirect()->route('attention.waitting')->with('flash', 'Ingreso Actualizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        event(new AdmissionWasDeleted($admission));
        $admission->delete();
        return redirect()->route('admission.index')->with('flash', 'Ingreso Eliminado');
    }
    /**
     * Update the specified admission status to "Finalizado".
     *
     * @param  \App\Admission  $admission
     * @return \Illuminate\Http\Response
     */
    public function endding($id)
    {

        $admission = Admission::where('id', $id)->first();
        $admission->status = 'Finalizado';
        $admission->finish_date = now();
        $admission->save();

        $admission->serviceorder->is_active = '1';
        $admission->serviceorder->save();

        // Register Statistics
        $billing = Carbon\Carbon::parse($admission->invoice_date);
        $finish = now();
        $finish = Carbon\Carbon::parse($finish);
        $finish_time = $billing->diffInMinutes($finish);


        $statistic_admission = StatisticAdmission::updateOrCreate(
            ['admission_id' => $admission->id],
            [
                'finish_time' => $finish_time
            ]
        );

        return redirect()->route('attention.index')->with('flash', 'Atención del Paciente Finalizada');
    }
}
