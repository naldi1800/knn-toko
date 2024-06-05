<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if ($request->user()->role === 'employee') {
            return redirect()->intended(route('employee.home'));
        } else {
            // dd($request->user());
            return redirect()->intended(route('home'));
        }
    }

    public function loginCustom(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        if (Auth::user()->role == 0) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } elseif (Auth::user()->role == 1) {
            $request->session()->regenerate();
            return redirect()->route('employee.home');
        } else {
            return redirect()->route('login')->with('error', "Wrong credentials");
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
