<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$getRole): Response
    {
        if($getRole==='doctor'){
            if(Auth::user()->role!=='doctor'){
                return back()->with('errormessages',['Not Authorised to see the page']);
            }
        }
        return $next($request);
    }
}