<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckPin
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
        $pinuser = new User;
        $pinuser = User::where('is_staff', '1')
                        ->where('pin', $request->pin)->first();   
        
        if($pinuser){
             return $next($request);
        }
        
       return back()->with('err', 'Error con el Pin Personal ');
    }
}
