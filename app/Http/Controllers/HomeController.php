<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Item;
use App\Models\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function admin()
    {
        $item = Item::all();
        $tItem = count($item);
        $tStock = array_sum(array_column($item->toArray(), 'stok'));

        $employee = Employee::all()->where('still_working', 1);
        $tEmployee = count($employee);
        $tEmployeeActiv = count($employee->where('active', 1));

        // date_default_timezone_set("Asia/Makassar");
        // $now = strtotime(date('m/d/Y h:i:s a', time()));
        // $days = [];
        // for ($i = 0; $i < 7; $i++) {
        //     $days[] = date('mdy', strtotime("-$i day", $now));
        // }

        // $dayNumber = (int) date('w', strtotime($days[0]));
        // $nota = "N" . $dayNumber . "-" . $days[0];
        // $saleintheday = Sale::where('kode_nota', 'like', "%{$days[0]}%")->groupBy('kode_nota')->get();



        return view('index', compact(['tItem', 'tStock', 'tEmployee', 'tEmployeeActiv']));
    }
    function employee()
    {
        return view('employee');
    }
}
