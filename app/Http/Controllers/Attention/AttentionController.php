<?php

namespace App\Http\Controllers\Attention;

use App\Admission;
use App\StatisticAdmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admissions = Admission::activated()->get();
        $waiting_room = Admission::activated()->get()->count();
        $today_patients = Admission::dailytotal()->get()->count();
        $in_progress = Admission::attending()->get()->count();
        $penddings = Admission::pendding()->get()->count();
        $time_to_attend = StatisticAdmission::AverageTimeAttending();


        return view('attention.waitting',
                    compact(    'admissions',
                                'waiting_room',
                                'today_patients',
                                'in_progress',
                                'penddings',
                                'time_to_attend'
                            ));
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attending()
    {
        $admissions = Admission::attending()->get();
        $waiting_room = Admission::activated()->get()->count();
        $penddings = Admission::pendding()->get()->count();
        $today_patients = Admission::dailytotal()->get()->count();
        $in_progress = Admission::attending()->get()->count();
        $time_to_attend = StatisticAdmission::AverageTimeAttending();




        return view('attention.attending',
                    compact(    'admissions',
                                'waiting_room',
                                'today_patients',
                                'in_progress',
                                'penddings',
                                'time_to_attend'
                            ));
    }
}
