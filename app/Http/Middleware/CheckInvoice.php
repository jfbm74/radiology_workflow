<?php

namespace App\Http\Middleware;

use Closure;
use App\Admission;
use Illuminate\Support\Facades\DB;

class CheckInvoice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->doctipo == 'OS'){
            $docclase = "FV00";
        }
        else{
            $docclase = "FV01";
        }

        $invoice = DB::connection('manager')
                ->table('manager.mngdoc')
                ->select(   'docnumero')
                ->where('docclase', $docclase)
                ->where('docnumero', $request->invoice)
                ->first();

        //Checks if given invoice number exists in ManagerDB


        if ($invoice) {
            //echo "la Factura Existe";
            //Check if given invoice number is associated with an Admission

            $admission = Admission::where('invoice_number', $request->invoice)
                                        ->where('doctype', $request->doctipo )
                                        ->first();
            if( ! $admission ){
                return $next($request);
            }
            else {

                return back()->with('err', 'Error: Ya existe un ingreso asociado a esa factura');
            }
        }
        return back()->with('err', 'Error: No existe la factura en Manager');
    }
}
