<?php

namespace App\Http\Controllers\Report;

use App\Exports\PaquetesExport;
use App\Printing;
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
     * Show page packages
     *
     * @return view
     */
    public function show_paquetes_form(Request $request)
    {
        # Case 1: Dates given
        $new_end_date = Carbon::parse($request->date_end)->addDay();
        //dd($new_end_date);
        if ($request->date_ini && $request->date_end) {
            $data = Printing::paquete
            (
                $request->date_ini,
                $new_end_date
            );
            //dd($data);
            return view('reports.main.paquetes', compact('data'));
        }

        return view('reports.main.paquetes');
    }

    /**
     * Show opportunity in attention of patients in xls exportable file.
     *
     * @param $request
     * @return File
     */
    public function paquetes_csv(Request $request){
            //Excel::download(new \App\Exports\PaquetesExport([$request->date_ini, $request->date_end]),
            //    'reporte_paquetes_'.Carbon::now().'.xlsx');
            return (new PaquetesExport($request->date_ini, $request->date_end))->download('Paquetes.xlsx');
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

        # Case 1: Data given: dates 
    if ($request->date_ini && $request->date_end)
    {
        $query = StatisticAdmission::
            technicianOpportunity($request->date_ini, $request->date_end);

        // Imprime la consulta SQL generada
        

        $data = $query->get();

        return view('reports.orders.opportunity', compact('data', 'staff'));
    }       
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

    /**
     * Show productivity report detailed.
     *
     * @param $request
     * @return
     */
    public function productivity_detail(Request $request){
        # Case 1: Dates given

        if ($request->date_ini && $request->date_end) {
            $data = Printing::
                productivitydetail
                (
                    $request->date_ini,
                    $request->date_end
                );
            //dd($data);
            return view('reports.main.productivity', compact('data'));
        }

        return view('reports.main.productivity');
    }

    /**
     * Show productivity report detailed in exportable xls.
     *
     * @param $request
     * @return '\Maatwebsite\Excel\Facades\Excel'
     */
    public function productivity_detail_csv(Request $request){

        return Excel::download(new \App\Exports\PrintingExport([$request->date_ini, $request->date_end]),
            'reporte_productividad_detalle_'.Carbon::now().'.xlsx');
    }
}
