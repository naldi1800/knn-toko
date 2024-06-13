<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $exept = ['_token'];
    public function index()
    {
        $datas = Sale::all()->where('still_working', '1');
        return view('employee.index', compact(['datas']));
    }

}
