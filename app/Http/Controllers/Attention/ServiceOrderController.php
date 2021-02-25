<?php

namespace App\Http\Controllers\Attention;

use App\Admission;
use App\BillDetail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Printig;
use App\ServiceOrder;
use App\ServiceOrderDetail;

class ServiceOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $check_user = 1;
        $user = User::pinpad($request->pin)->first();        
        $admission = new Admission();
        $admission = Admission::where('id' , $request->admission)->first();
        $orders = new BillDetail();
        
        /* Search for equivalences in BillDetail */
        $orders = app()->call('App\Http\Controllers\PackageController@search', [ 'billdetails' => $admission->billdetail]);
         
        
        /** check if a patient is register as user in Portal  and returns email*/
        if ($admission->user_id == 999) {
            if ($admission->delivery == 'Virtual' || $admission->delivery == 'Ambas' ) {
               $check_user = User::where('legal_id', $admission->patient->legal_id)->first();
               if ($check_user) {
                    $check_user = $check_user->email;
                    /* return form view in order to create SO's */
                    return view('attention.create', compact('user', 'admission', 'orders', 'check_user'));
               }
                                       
            }
        }
        /* return form view in order to create SO's */
        return view('attention.create', compact('user', 'admission', 'orders', 'check_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //return $request->all();

        $user = User::where('id', $request->user)->first();
        
        $admission = Admission::where('id' , $request->admission)->first();

        //Saving OS   
        $os_master =  ServiceOrder::firstOrCreate([
            'admission_id' => $admission->id 
        ], [
            'user_id'   => $request->user,
            'is_active' => 0
        ]);
        
        
        //  Saving OS Details
         $i = 0;
        foreach ($request->orders as  $order) {

            $i +=1;
            $ins_order = ServiceOrderDetail::firstOrCreate([
                'service_order_id'  => $os_master->id, 
                'ordinal'           => $i
            ], [
                'name'              => $order,
                'status'            => 'nuevo'
            ]);
                  
        }
        
        // Creating an User-Patient in Portal
        // Checking if User exists
        
        if ($admission->user->id == 999 && ($admission->delivery == "Virtual" || $admission->delivery == "Ambas") ) {
            $new_user = app()->call('App\Http\Controllers\Admin\UserController@create_user_generic', [ 
                'email' => $request->email_patient, 'id'=> $admission->patient->legal_id]);
        }

        $admission->save();

        //returning view Attending Patient in progress 
        return view('attention.createprinting', compact('admission', 'user'));
        
    }


    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $admission)
    {
        $users =  User::all();
        
        return view('attention.edit', compact('admission', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,  $id)
    {
        
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
}
