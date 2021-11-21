<?php

namespace App\Http\Controllers\Admission;

use App\Photos;
use App\Patient;
use App\Admission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('portal.index', compact(
            'patients'
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
    public function store($request)
    {
        $request->name = Str::upper($request->name);
        //dd($request);
        //Save Patient (name, legal_id, birthday)
        try {
            $patient = Patient::firstOrCreate([
                'name' => $request->name,
                'legal_id' => $request->patient_id,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'weight' => $request->patient_weight
            ]);
            return $patient;

        } catch (\Throwable $th) {

        }
        $patient = Patient::where('legal_id', $request->patient_id)->first();
        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->birthday = $request->birthday;
        $patient->weight = $request->patient_weight;
        $patient->save();
        return $patient;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $patient)
    {
        $patient = Patient::where('id', $patient->id)->first();

        return view('portal.patient', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function gallery(Admission $admission){

        $patient = $admission->patient;

        $photos =$admission->photos;

        return view('portal.gallery', compact('photos', 'patient' , 'admission'));
    }

    public function zoom(Admission $admission, Photos $photo){

        $patient = $admission->patient;
        $photo_zoom = $photo;
        $photos =$admission->photos;

        return view('portal.zoom', compact('photo_zoom', 'photos', 'patient' , 'admission'));
    }

    /**
     * Update email of the specified patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_email(Request $request, $id)
    {
        //email validation
        $this->validate($request, [
            'user_email' => 'email'
        ]);

        try {
            $patient = Patient::where('id', $id)->first();
            $patient->email = $request->user_email;
            $patient->save();
            return back()->with('flash', 'Correo Actualizado');
        } catch (\Throwable $th) {
        }
        return back()->with('err', 'Error desconocido');
    }


}
