<?php

namespace App\Http\Controllers\Dashboard;

use App\Admission;
use App\BillDetail;
use App\Patient;
use App\Printing;
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

        # Pending Admissions
        $pending_admission = Admission::pendding()->count();
        # Pending Admissions
        $pending_older_admission = Admission::pendingolders()->count();


        #Return view
        return view('dashboard.manager.index',
            compact(
                'monthly_patients',
                'monthly_orders',
                'monthly_oportunity',
                'pending_admission',
                'pending_older_admission'
            ));
    }


    /**
     * Return a JSON object with number orders cummulative by month.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get_orders_json_yearly(){

        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();
        $year_ago = Carbon::now()->subMonths(12);

        # Orders By Month graph
        $data_orders = Printing::quantyordersbydate(
            $year_ago,
            $today
        );
        //dd($data_orders);
        return $data_orders->toJson();
    }

    /**
     * Return a JSON object with number opportunity cumulative by month.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get_opportunity_json_yearly(){

        $today = Carbon::now();
        $year_ago = Carbon::now()->subMonths(12);

        # Orders By Month cumulative
        $data_opportunity = StatisticAdmission::opportunityordersbymonth(
            $year_ago,
            $today
        );
        //dd($data_opportunity);
        return $data_opportunity->toJson();
    }

    /**
     * Return a JSON object with product's quantity by month.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get_product_json_montly(){

        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();

        # Orders By Month cumulative
        $data_products = Printing::quantyproductsbydate(
            $month_ago,
            $today
        );
        //dd($data_products);
        return $data_products->toJson();
    }

    /**
     * Return a JSON object with product's quantity by month.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get_package_json_montly(){

        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();

        # Package By Month cumulative
        $data_package = BillDetail::quantypackagesbymonth(
            $month_ago,
            $today
        );
        //dd($data_package);
        return $data_package->toJson();
    }

    /**
     * Return a JSON object with Professional's quantity orders by month.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get_professionals_json_montly(){

        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();

        # Package By Month cumulative
        $professional_package = Printing::quantyordersprofessionalbymonth(
            $month_ago,
            $today
        );
        //dd($professional_package);
        return $professional_package->toJson();
    }


    /**
     * Return a JSON object with Techinician's quantity orders by month.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function get_technicians_json_monthly(){

        $today = Carbon::now();
        $month_ago = Carbon::now()->subMonth();

        # Package By Month cumulative
        $technicians_quanty = Printing::OrdersTechnicianByMonth(
            $month_ago,
            $today
        );
        //dd($technicians_quanty );
        return $technicians_quanty ->toJson();
    }


}
