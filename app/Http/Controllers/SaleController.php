<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $exept = ['_token'];
    public function index()
    {
        $datas = Sale::with('item')->with('employee')->get();
        return view('sale.index', compact(['datas']));
    }

}
