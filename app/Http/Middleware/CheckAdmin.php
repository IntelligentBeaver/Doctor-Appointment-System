<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $group): Response
    {
        if ($group === 'admin') {
            if (Auth::user()->role !== 'admin') {
                return back()->with('errormessages', ['Not Authorised to see the page']);
            }
        }
        return $next($request);
    }
}