<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Change this condition to check if the user is NOT authenticated
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        $userRole = Auth::user()->role;
       
        if($userRole == 1)
        {
            return redirect()->route('superadmin.dashboard');
           
        }
        if ($userRole == 2){
            return $next($request); // Allow access for admin
        }
        if ($userRole == 3){
            return redirect()->route('dashboard'); // Redirect normal users
        }
    }
}
