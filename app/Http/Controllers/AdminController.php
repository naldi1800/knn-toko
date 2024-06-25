<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.resetpass', compact([]));
    }

    public function update_pass(Request $request)
    {
        if ($request->input('password') === $request->input('repassword')) {

            if (Hash::check($request->input('current_password'), $request->user()->password)) {
                $request->user()->update([
                    'password' => Hash::make($request['password']),
                ]);
            } else {
                return back()->with('error', 'current password wrong');
            }
            return back()->with('status', 'Password Berubah');
        }
        return back()->with('error', '\'Password baru ulang tidak\' sama dengan \'password baru\'');
    }
}
