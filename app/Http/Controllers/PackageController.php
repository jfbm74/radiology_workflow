<?php

namespace App\Http\Controllers;

use App\BillDetail;
use App\Package;
use App\PackageDetail;
use App\Product;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admissions = Package::all();
        return view('config.package.index', compact('admissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('is_package', 0)->get();

        return view('config.package.create', compact('products'));
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
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }

    /**
     * search for equivalences with bill detaill.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function search($billdetails)
    {
        $orders = [];
        foreach ($billdetails as $billdetail) {
            $os_temp = Package::where('code' , $billdetail->codprod)->first();
            if ($os_temp) {
                $equivalencias =  PackageDetail::where('package_id', $os_temp->id)->get();
                foreach ($equivalencias as $equivalencia) {
                    array_push($orders, $equivalencia->product->cod_manager);

                }
            } else {
                array_push($orders, $billdetail->codprod);
            }
        }
        return $orders;
    }
}
