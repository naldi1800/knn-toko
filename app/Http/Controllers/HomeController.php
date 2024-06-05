<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function admin()
    {
        return view('index');
    }
    function employee()
    {
        return view('employee');
    }
}
