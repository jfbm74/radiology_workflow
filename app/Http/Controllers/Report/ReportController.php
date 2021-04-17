<?php

namespace App\Http\Controllers\Report;

use App\ServiceOrderDetail;
use App\StatisticAdmission;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\File;

class ReportController extends Controller
{

    /**
     * Show index page for reports.
     *
     * @return view
     */
    public function index()
    {
        return view('reports.index');
    }



    /**
     * Show opportunity in attention of patients.
     *
     * @param $request
     * @return
     */
    public function opportunity(Request $request)
    {
        $staff = User::getstaff()->get();

        # Case 1: Data given: dates and technician
        if ($request->date_ini && $request->date_end && $request->technician)
        {
            $data = StatisticAdmission::
                technicianopportunity
            (
                    $request->date_ini,
                    $request->date_end,
                    $request->technician
            );
            return view('reports.orders.opportunity', compact('data', 'staff'));
        }
       # case 2: Both dates quiven
        if ($request->date_ini && $request->date_end)
        {
            $data = StatisticAdmission::opportunity($request->date_ini, $request->date_end);
            return view('reports.orders.opportunity', compact('data', 'staff'));
        }
        # case 3: None parameters given
        else{
            return view('reports.orders.opportunity', compact('staff'));
        }
    }

    /**
     * Show opportunity in attention of patients in xls exportable file.
     *
     * @param $request
     * @return File
     */
    public function opportunity_csv(Request $request){
        return Excel::download(new \App\Exports\StatisticAdmissionExport([$request->date_ini, $request->date_end]),
            'reporte_oportunidad_'.Carbon::now().'.xlsx');
    }


    /**
     * Show patients dosimetry.
     *
     * @param $request
     * @return
     */
    public function dosimetry(Request $request)
    {
        # Case 1: Dates given
        if ($request->date_ini && $request->date_end)
        {
            $data = ServiceOrderDetail::
                dosimetrybydate
            (
                $request->date_ini,
                $request->date_end
            );
            return view('reports.patients.dosimetry', compact('data'));
        }
        return view('reports.patients.dosimetry');
    }

    /**
     * Show patients dosimetry in xls exportable file.
     *
     * @param $request
     * @return File
     */
    public function dosimetry_csv(Request $request){
        return Excel::download(new \App\Exports\ServiceOrderDetailExport([$request->date_ini, $request->date_end]),
            'reporte_dosimetria_'.Carbon::now().'.xlsx');
    }


}
