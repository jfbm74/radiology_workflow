<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Probar conexion a BD-PGSQL ManageR
        $user = DB::connection('manager')
                ->table('manager.dlluser')
                ->where('usrcodigo', 'CONT')
                ->first();

        return view('home', compact('user'));
    }
}
