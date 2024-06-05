<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private $exept = ['_token'];
    public function index()
    {
        $datas = Employee::all()->where('still_working', '1');
        return view('employee.index', compact(['datas']));
    }

    public function phk()
    {
        $datas = Employee::all()->where('still_working', '0');
        return view('employee.pegawaidipecat', compact(['datas']));
    }

    public function create()
    {
        return view('employee.create');
    }
    public function edit($id)
    {
        $d = Employee::find($id);
        return view('employee.update', compact('d'));
    }
    public function save(Request $request)
    {
        Employee::create($request->except($this->exept));
        return redirect()->route('employees');
    }
    public function update(Request $request, $id)
    {
        $data = Employee::find($id);
        $account = !empty(User::where('email', $data->email)->first());

        $exept[] = "value";
        // dd($exept);
        $data->update($request->except($this->exept));
        return redirect()->route('employees');
    }
    public function account($id)
    {
        $data = Employee::find($id);
        $pass = "012345" . strtoupper(explode(' ', $data->nama)[0]);
        // dd($pass);  
        User::create([
            'name' => $data->nama,
            'email' => $data->email,
            'password' => Hash::make($pass),
            'role' => 'employee',
        ]);
        return redirect()->route('employees');
    }
    public function defaultpassword($id)
    {
        $data = Employee::find($id);
        $pass = "012345" . strtoupper(explode(' ', $data->nama)[0]);
        // dd($pass);  
        $account = User::firstWhere('email', '=', $data->email);
        $account->Update([
            'password' => Hash::make($pass),
        ]);
        return redirect()->route('employees');
    }

    public function pecat($id, $state)
    {
        $data = Employee::find($id);
        $data->Update([
            'still_working' => $state,
        ]);

        return redirect()->route(!$state?'employees' : 'employees.phk');
    }
}
