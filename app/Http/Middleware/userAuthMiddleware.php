<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class userAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(Auth::check())) {
            return redirect()->route('login')->with('error', 'You dont login!');
        }
        if (Auth()->user()->role == 'employee') {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'You do not have permission to access this page !');
        }
    }
}
