<?php

namespace App\Http\Controllers\Attention;

use App\Admission;
use App\BillDetail;
use App\Patient;
use App\Product;
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

        /** Search for equivalences in BillDetail */
        $orders = app()->call('App\Http\Controllers\PackageController@search', [ 'billdetails' => $admission->billdetail]);

        /** Convert Orders into Products */
        $prod = [];
        foreach ($orders as $order) {
            $temp = Product::where('cod_manager' ,$order)->first();
            array_push($prod, $temp);
        }
        $orders = $prod;

        /** check if a patient is register as user in Portal  and returns email*/
        if ($admission->user_id == 999) {
            if ($admission->delivery == 'Virtual' || $admission->delivery == 'Ambas' ) {
               $check_user = Patient::where('id', $admission->patient->id)->first();
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
                'product_id'         => $order,
                'status'             => 'nuevo'
            ]);
            $ins_order->product_id = $order;
            $ins_order->save();

        }

        //Updating Patient's email when delivery is "Virtual" or "Ambas"
        if ($admission->user->id == 999 && ($admission->delivery == "Virtual" || $admission->delivery == "Ambas") ) {
            // Retrieve patient ID
            $patient = Patient::find($admission->patient->id);
            $patient->email = $request->user_email;
            $patient->save();
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
