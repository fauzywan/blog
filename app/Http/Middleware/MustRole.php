<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MustRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role='')
    {
        if(Auth::user()->role_id==3){
            return  redirect('creator/dashboard');
        }
        if($role==1){

            if(Auth::user()->role_id!=1)
            {
                return  redirect('admin/dashboard');
            }  
        }
      
        return $next($request);
    
    }
}
