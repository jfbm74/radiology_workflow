<?php

namespace App\Http\Controllers\Attention;

use App\User;
use App\Printing;
use App\Admission;
use App\ServiceOrder;
use App\ServiceOrderDetail;
use App\StatisticAdmission;
use Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PrintingController extends Controller
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

        $admission = Admission::where('id', $request->admission)->first();

        $os = ServiceOrder::where('admission_id', $admission->id)->first();

        $os_details = ServiceOrderDetail::where('service_order_id', $os->id)->get();

        //Saving Printings
        $ordinal = 0;
        foreach ($os_details as $os_detail) {
            foreach ($request->print as $order => $type) {
                if ($os_detail->name == $order) {
                    if ($order == $os_detail->name) {
                        foreach ($type as $type_printing => $quanty) {
                            $ordinal += 1;
                            if ($quanty > 0) {
                                $printing = Printing::firstOrCreate(
                                    [
                                        'service_order_details_id'  => $os_detail->id,
                                        'ordinal'                   => $ordinal
                                    ],
                                    [
                                        'type'                      => $type_printing,
                                        'quanty'                    => $quanty,
                                        'is_printed'                => 0
                                    ]
                                );
                            }
                        }
                    }
                }
            }
        }

        $admission->status = 'En Atención';
        // Register Patient Calling Time
        $admission->calling_date = now();
        $admission->save();
        // Register Statistics
        $billing = Carbon\Carbon::parse($admission->invoice_date);
        $waiting = now();
        $waiting = Carbon\Carbon::parse($waiting);
        $waiting_time = $billing->diffInMinutes($waiting);


        $statistic_admission = StatisticAdmission::firstOrCreate(
            ['admission_id' => $admission->id],
            [
                'waiting_time' => $waiting_time,
                'user_id' => $admission->serviceorder->user->id,
                'professional_id' => $admission->user_id,
                'admission_date' => $admission->invoice_date
            ]
        );

        return redirect()->action([AttentionController::class, 'attending']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        //return $request->all();
        $admission = Admission::where('id', $request->admission_id)->first();
        $os = ServiceOrder::where('admission_id', $admission->id)->first();
        $os_details = ServiceOrderDetail::where('service_order_id', $os->id)->get();

        //Verifing if user Generic is on user's table

        if ($admission->user->name ==  'GENERICO') {
            if ( $admission->delivery == 'Virtual' || $admission->delivery == 'Ambas') {
                $generic_user =  User::where('legal_id', $admission->patient->legal_id)->first();

                if (is_null ($generic_user)) {

                    return view('results.show', compact('os_details', 'admission','generic_user'));
                }
                else {
                    $generic_user =$generic_user->email;

                    return view('results.show', compact('os_details', 'admission', 'generic_user'));
                }

            }
        }

        return view('results.show', compact('os_details', 'admission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Returnando vista de editar";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {

        $os = ServiceOrder::where('admission_id', $admission->id)->first();
        $os_details = ServiceOrderDetail::where('service_order_id', $os->id)->get();

        //Saving Printings
        foreach ($os_details as $osd) {
            foreach ($request->print as $order => $items) {
                foreach ($items as $key => $value) {
                    if ($osd->name ==  $order) {
                        if (!is_null($value)) {
                            if ($printing = Printing::where('service_order_details_id', $osd->id)
                                ->where('type', $key)
                                ->first()
                            ) {
                                $printing->quanty = $value;
                                $printing->save();
                            } else {
                                $printing = new Printing;
                                $printing->service_order_details_id = $osd->id;
                                $printing->type = $key;
                                $printing->quanty = $value;

                                //retrieving max agregate
                                $max = Printing::where('service_order_details_id', $osd->id)->max('ordinal');
                                $max = $max + 1;
                                $printing->ordinal = $max;

                                $printing->save();
                            }
                        }
                    }
                }
            }

            return redirect()->action([AttentionController::class, 'attending']);
        }
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendding_list()
    {
        $admissions = Admission::pendding()->get();
        $waiting_room = Admission::activated()->get()->count();
        $today_patients = Admission::dailytotal()->get()->count();
        $penddings = Admission::pendding()->get()->count();
        $in_progress = Admission::attending()->get()->count();
        $time_to_attend = StatisticAdmission::AverageTimeAttending();



        return view(
            'attention.pendding',
            compact(
                'admissions',
                'waiting_room',
                'today_patients',
                'penddings',
                'in_progress',
                'time_to_attend'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print_one(Request $request)
    {

        $printing = Printing::where('id', $request->printing_id)->first();
        $printing->printed = $printing->printed + 1;
        if ($printing->printed == $printing->quanty) {
            $printing->is_printed = 1;
            $printing->printed_date = now();
        }
        $printing->save();


        $admission = $printing->serviceorderdetail->serviceorder->admission;

        return redirect()->route('printing.show', ['admission_id' => $admission])->with('flash', 'Registro de impresión guardado');
    }

    public function print_repeated(Request $request)
    {

        $printing = Printing::where('id', $request->printing_id)->first();
        $printing->repeated = $printing->repeated + 1;
        $printing->save();

        $admission = $printing->serviceorderdetail->serviceorder->admission;

        return redirect()->route('printing.show', ['admission_id' => $admission])->with('flash', 'Registro de impresión repetida guardado');
    }

    public function confirm_photo($id)
    {

        $admission = Admission::where('id', $id)->first();
        $os_dets = $admission->serviceorder->serviceorderdetail;
        foreach ($os_dets as $os_det) {
            $ops = $os_det->printing;
            foreach ($ops as $op) {
                if ($op->type == 'Virtual') {
                    $op->printed = 1;
                    $op->is_printed = 1;
                    $op->printed_date = now();
                    $op->save();
                }
            }
        }
        return redirect()->route('printing.show', ['admission_id' => $admission->id])->with('flash', 'Imagen guardada en Portal Pacientes');
    }
}
