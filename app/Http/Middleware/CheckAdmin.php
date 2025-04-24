<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckAdmin
{
 


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd('AdminMiddleware is working!');


        if(!empty(auth()->guard('admin')->id()))
        {
            $data = DB::table('admins')
                    ->select('admins.usertype','admins.id')
                    ->where('admins.id',auth()->guard('admin')->id())
                    ->get();
            
            if (!$data[0]->id  && $data[0]->usertype != 'W')
            {
                return redirect()->intended('admin/login/')->with('status', 'You do not have access to admin side');
            }
            
            return $next($request);
        }
        else 
        {
            return redirect()->intended('admin/login/')->with('status', 'Please Login to access admin area');
        }
    }
}
