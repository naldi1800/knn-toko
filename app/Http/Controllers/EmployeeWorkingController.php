<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Basket;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeWorkingController extends Controller
{
    private $exept = ['_token'];
    public function index($search = null)
    {
        $account = Employee::where('email', auth()->user()->email)->first();
        $basket = Basket::where('id_employees', $account->id)->with('item')->get();
        date_default_timezone_set("Asia/Makassar");
        $now = strtotime(date('m/d/Y h:i:s a', time()));
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = date('mdy', strtotime("-$i day", $now)) . "-" . $account->id;
        }


        // dd($days);

        // 0 - 6 : Sunday - Saturday
        $dayNumber = (int) date('w', strtotime($days[0]));
        // dd($dayNumber);
        $nota = "N" . $dayNumber . "-" . $days[0] . "-" . $account->id;
        $saleintheday = Sale::where('id_employees', $account->id)->where('kode_nota', 'like', "%{$days[0]}%")->groupBy('kode_nota')->get();
        // dd($saleintheday);
        $saleintheday = $saleintheday->count();

        // $saleintheweak = Sale::where('id_employees', $account->id)->whereIn('kode_nota', $days)->groupBy('kode_nota')->where->get();
        $saleintheweak = Sale::where('id_employees', $account->id)->Where(function ($query) use ($days) {
            foreach ($days as $d) {
                $query->orWhere('kode_nota', 'like', "%{$d}%");
            }
        })->groupBy('kode_nota')->get();    


        // dd($saleintheweak);
        if (!is_null($search)) {
            $searchItem = $search;
            $search = Item::where('name', 'like', "%{$searchItem}%")->orWhere('kode', 'like', "%{$searchItem}%")->get();
        }
        $saleintheweak = $saleintheweak->count();

        // dd($search);
        return view('employee', compact(['basket', 'search', 'account', 'saleintheday', 'saleintheweak']));
    }

    public function search(Request $request)
    {
        if ($request == null)
            return redirect('employee.home');

        $data = $request->all();

        return redirect()->route('employee.search', ['search' => $data['search']]);
    }

    public function keranjang($id)
    {
        $account = Employee::where('email', auth()->user()->email)->first();
        $save = Item::find($id);

        $cek = Basket::where('id_item', $id)->where('id_employees', $account->id)->first();
        if (empty($cek)) {
            $data = [
                'id_employees' => $account->id,
                'id_item' => $save->id,
                'jumlah' => 1,
                'harga' => $save->harga,
                'diskon' => $save->diskon,
            ];
            Basket::create($data);
        } else {
            $cek->update([
                'jumlah' => $cek->jumlah + 1,
            ]);
        }
        return redirect()->route('employee.home');
    }

    public function add($id)
    {
        $data = Basket::find($id);
        $data->update([
            'jumlah' => $data->jumlah + 1,
        ]);
        return redirect()->route('employee.home');

    }
    public function minus($id)
    {
        $data = Basket::find($id);
        if ($data->jumlah > 1) {
            $data->update([
                'jumlah' => $data->jumlah - 1,
            ]);
        }
        return redirect()->route('employee.home');
    }

    public function bayar()
    {
        $account = Employee::where('email', auth()->user()->email)->first();
        $basket = Basket::where('id_employees', $account->id)->with('item')->get();

        date_default_timezone_set("Asia/Makassar");
        $now = date('m/d/Y h:i:s a', time());

        // 0 - 6 : Sunday - Saturday
        $dayNumber = (int) date('w', strtotime($now));
        $date = date('mdy', strtotime($now));
        $nota = "N" . $dayNumber . "-" . $date . "-" . $account->id;
        $sale = Sale::where('id_employees', $account->id)->where('kode_nota', 'like', "%{$nota}%")->get();
        $salesontheday = $sale->count();
        $salesontheday += 1;
        $nota .= "-" . $salesontheday;




        foreach ($basket as $b) {
            $total = $b->harga * $b->jumlah;

            $data = [
                'id_employees' => $account->id,
                'id_item' => $b->item->id,
                'kode_nota' => $nota,
                'jumlah' => $b->jumlah,
                'harga' => $b->harga,
                'diskon' => $b->diskon,
                'total' => $total,
            ];
            Sale::create($data);
        }
        foreach ($basket as $b) {
            $b->delete();
        }
        return redirect()->route('employee.home');
    }

    public function delete(Request $request, $id)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $user = null;
            $basket = Basket::find($id);
            $basket->delete();
            return redirect()->route('employee.home');
        } else {
            return back()->withErrors(['error' => 'Invalid email or password']);
        }
    }

}
