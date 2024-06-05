<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = 'employee'): Response
    {


        // if (!Auth::guard($guard)->check()) {
        //     return redirect('/login');
        // }

        return $next($request);

        // if (Auth::user()->role == 'employee') {
        //     return redirect()->intended(route('employee.home'));
        // } else
        // dd($role);
        //  if (Auth::user()->role != 'admin') {
        //     return redirect()->intended(route('home'));
        // }
        // return $next($request);
        // if(!empty(Auth::check())){

        // }
        // else{
        //     Auth::logout();
        //     return redirect(url(''));
        // }
    }
}
