<?php

namespace App\Http\Controllers\Attention;

use App\User;
use App\Admission;
use App\ServiceOrder;
use App\ServiceOrderDetail;
use App\Http\Controllers\Attention\PrintingController;
use Illuminate\Http\Request;
use ServiceOrderDetailSeeder;
use Carbon;
use App\StatisticAdmission;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class FullfilmentController extends Controller
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update Order Detail Fullfilment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::pinpad($request->pin)->first();
        $orderdetail = ServiceOrderDetail::where('id', $request->orderservicedetail)->first();

        //Updating ServiceOrderDetail Item to 'cumplido'
        $orderdetail->status = 'cumplido';
        $orderdetail->fullfilment_date = now();
        $orderdetail->user_id =  $user->id;
        $orderdetail->save();

        $admissions = Admission::attending()->get();

        //returning view Attending Patient in progress
        //return view('attention.attending', compact('admissions'));
        return back()->with('flash', 'Orden cumplida');  
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

    /**
     * Complete the remaining Service Orders.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {

        $user = User::where('pin', $request->pin)->first();
        $admission = Admission::where('id', $request->admission)->first();
        $os = ServiceOrder::where('admission_id', $request->admission)->first();
        $os_details_new = ServiceOrderDetail::where('service_order_id', $os->id)
            ->where('status', 'nuevo')->get();
        
           
        //dd($os_details_new);        
            foreach ($os_details_new as $os_detail_new) {
                $updte = $os_detail_new;
                $updte->service_order_id = $os->id;
                $updte->status = 'cumplido';
                $updte->fullfilment_date = now();
                $updte->user_id = $user->id;
                $updte->save();
                //print_r($updte);
                
            }

        $admission->status = 'Pendiente';
        $admission->attending_date = now();
        $admission->save();

         // Register Statistics
         $billing = Carbon\Carbon::parse($admission->invoice_date);
         $attention = now();
         $attention = Carbon\Carbon::parse($attention);
         $attention_time = $billing->diffInMinutes($attention);
         
 
         $statistic_admission = StatisticAdmission::updateOrCreate(
             ['admission_id' => $admission->id],
             [
                 'attention_time' => $attention_time
             ]
         );

       
         return redirect()->action('Attention\PrintingController@show',
                                     ['admission_id' => $admission->id]);
    }
}
