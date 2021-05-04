<?php

namespace App\Http\Controllers\Billing;

use App\Bill;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('billing.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($bill)
    {

        //Search Invoice into ManagarDB
        $invoice = DB::connection('manager')
                ->table('manager.mngdoc')
                ->join('manager.vendedor', 'docvende', '=', 'vencodigo' )
                ->join('manager.vinculado', 'docvincula', '=', 'vincedula' )
                ->select(   'docclase',
                            'doctipo',
                            'docnumero',
                            'docvincula',
                            'docnewfec',
                            'docvende',
                            'vennombre',
                            'vinnombre',
                            'vinfnacio'
                            )
                ->where('docclase', 'FV00')
                ->where('docnumero', $bill)
                ->first();

        // Search for Invoice Details
        $details = DB::connection('manager')
                ->table('manager.mngmcn')
                ->join('manager.producto', 'mcnproduct', '=', 'procodigo' )
                ->select(   'mcnproduct',
                            'pronombre', 'mcncantid')
                ->where('mcnnumedoc', $bill)
                ->get();

        return view('/home', compact('invoice', 'details'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy($bill)
    {
        //
    }

    /**
     * Searhc a created invoice in MaganerBD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        // flag for detail product, if at least one product is tagged as virtual then its value is 1
        $is_virtual= 0;

        if ($request->doctipo == 'OS'){
            $docclase = "FV00";
        }
        else{
            $docclase = "FV01";
        }

        $bill = $request->invoice;
        $doctipo = $request->doctipo;

        //Search Invoice into ManagarDB
        $invoice = DB::connection('manager')
                ->table('manager.mngdoc')
                ->join('manager.vendedor', 'docvende', '=', 'vencodigo' )
                ->join('manager.vinculado', 'docvincula', '=', 'vincedula' )
                ->select(   'docnumero',
                            'docclase',
                            'doctipo',
                            'docnumero',
                            'docvincula',
                            'docnewfec',
                            'docvende',
                            'vennombre',
                            'vinnombre',
                            'vinfnacio',
                            'doctipo',
                            'vintelefon'
                            )
                ->where('docclase', $docclase)
                ->where('docnumero', $bill)
                ->where('doctipo', $doctipo)
                ->first();

        // Search for Invoice Details
        $details = DB::connection('manager')
                ->table('manager.mngmcn')
                ->join('manager.producto', 'mcnproduct', '=', 'procodigo' )
                ->select(   'mcnreg',
                                    'mcnproduct',
                                    'pronombre',
                                    'mcncantid'
                            )
                ->where('mcnnumedoc', $bill)
                ->where('mcntipodoc', $doctipo)
                ->orderBy('mcnreg', 'asc')
                ->get();

        // Checking if detail product is tagged as Virtual
        foreach ($details as $det){
            if ($det->pronombre == "."){
                continue;
            }
            else
            {
                $chk_prod = Product::where('cod_manager', $det->mcnproduct)->first();
                if ($chk_prod->is_virtual == 1)
                {
                    $is_virtual = 1;
                    break;
                }
            }
        }
        //dd($request);
        return view('admission.create', compact('invoice', 'details', 'is_virtual'));
    }
}
