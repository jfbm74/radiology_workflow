<?php

namespace App\Http\Controllers\Report;

use App\StatisticAdmission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
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

}
