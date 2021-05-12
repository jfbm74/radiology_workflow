<?php

namespace App\Http\Controllers\Attention;

use App\Product;
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

        //retrive Product
        $product = Product::where('id', $orderdetail->product_id)->first();
        // Updating radiation dose parameters
        $orderdetail->kv = $request->kv;
        $orderdetail->ma = $request->ma;
        $orderdetail->dosis = $request->dosis;
        $orderdetail->extime = $request->extime;

        if ($product->radiation_dose_type == 1)
        {
            $dose = app()->call('App\Http\Controllers\Attention\FullfilmentController@calculate_dose', [
                'request' => $request,
                'product' => $product
            ]);
            $orderdetail->dosis = $dose;
        }
        $orderdetail->save();

        $admission = $orderdetail->serviceorder->admission;


        $statistic_admission = StatisticAdmission::updateOrCreate(
            ['admission_id' => $admission->id],
            [
                'user_id' => $user->id
            ]
        );

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

        $user = auth()->user();
        $admission = Admission::where('id', $request->admission)->first();
        $os = ServiceOrder::where('admission_id', $request->admission)->first();
        $os_details_new = ServiceOrderDetail::where('service_order_id', $os->id)
            ->where('status', 'nuevo')->get();


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
                 'attention_time' => $attention_time,
                 'user_id' => $user->id
             ]
         );

         return redirect()->action('Attention\PrintingController@show',
                                     ['admission_id' => $admission->id]);
    }

    /**
     * Calculating ionizing radiation dose.
     *
     * @param  Product  $product
     * @param  Request $request
     * @return int dose ionizing radiation dose
     */
    public function calculate_dose (Request $request, Product $product) {

        switch ($product->radiation_dose_type){
            case 1:
                echo "Periapical";

                $dose = ((-1.533)*($request->extime*$request->extime*$request->extime))
                    +((0.5337)*$request->extime*$request->extime)+((1.0363) * $request->extime);
                break;
            case 2:
                echo "X-ray";
                $dose = (3.9988)*($request->exposure_time);
                break;
            case 0:
                echo 'No definido';
                $dose = 0;
                break;
        }
        return $dose;
    }
}
