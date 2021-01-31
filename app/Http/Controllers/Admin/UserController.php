<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all Users
        $users = User::all();
        
        return view('admin.users.index', compact('users'));     
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
    public function store($id)
    {
        //Check for current user in DB Portal
        $usr_exists = User::where('id', $id )->first();
        if ($usr_exists) {
           return $usr_exists;
        }

        //Search for given user on DB Manager
        $usr_manager = DB::connection('manager')
                ->table('manager.vendedor')
                ->where('vencodigo', $id)
                //->select('vencodigo', 'vennombre', 'vencedula')
                ->first();  
                
        //Saving user in DB
        $user = new User;
        $user->name = $usr_manager->vennombre;
        $user->id = $usr_manager->vencodigo;
        $user->legal_id = $usr_manager->vencedula;
        $user->password = bcrypt('12345678');
        $user->save();

        //Returning User
        return $user;
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
     * Update email of the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function email_update(Request $request, $id)
    {
        
        //email validation
        $this->validate($request, [
            'user_email' => 'email'
        ]);

        
        try {
            $user = User::where('id', $id)->first();
            $user->email = $request->user_email;
            $user->save();
            return back()->with('flash', 'Correo Actualizado');
            
        } catch (\Throwable $th) {
          
        }
        
        return back()->with('err', 'Error desconocido');
        

    }


}
