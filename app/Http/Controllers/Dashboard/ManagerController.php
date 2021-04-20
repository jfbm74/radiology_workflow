<?php

namespace App\Http\Controllers\Dashboard;

use App\Admission;
use App\Patient;
use App\ServiceOrderDetail;
use App\StatisticAdmission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    /**
     * Display a listing homepage for admin / manager.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();
        $year_ago = Carbon::now()->subMonths(12);

        # Number of patients last 30 days
        $monthly_patients = Admission::patients(
            $month_ago,
            $today
        )->count();

        # Number of Orders last 30 days
        $monthly_orders = ServiceOrderDetail::quantyorders(
            $month_ago,
            $today
        )->count();

        # Attention Opportunity in minutes
        $monthly_oportunity = StatisticAdmission::opportunityaverage(
            $month_ago,
            $today
        );

        # Pendding Admissions
        $pending_admission = Admission::pendding()->count();

        #Return view
        return view('dashboard.manager.index',
            compact(
                'monthly_patients',
                'monthly_orders',
                'monthly_oportunity',
                'pending_admission',
            ));
    }

    public function get_orders_json_yearly(){

        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();
        $year_ago = Carbon::now()->subMonths(12);

        # Orders By Month graph
        $data_orders = ServiceOrderDetail::quantyordersbymonth(
            $year_ago,
            $today
        );
        //dd($data_orders);
        return $data_orders->toJson();

    }

    /**
     * Display a home page for technicians
     *
     * @return \Illuminate\Http\Response
     */
    public function index_technician()
    {

        return view('dashboard.technician.index');
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
}
