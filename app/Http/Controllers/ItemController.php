<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $exept = ['_token'];
    public function index()
    {
        $datas = Item::all();
        return view('item.index', compact(['datas']));
    }
    public function create()
    {
        return view('item.create');
    }
    public function edit($id)
    {
        $d = Item::find($id);
        return view('item.update', compact('d'));
    }
    public function save(Request $request)
    {
        Item::create($request->except($this->exept));
        return redirect()->route('items');
    }
    public function update(Request $request, $id)
    {
        $data = Item::find($id);
        $data->update($request->except($this->exept));
        return redirect()->route('items');
    }

    public function addStock(Request $request, $id)
    {
        $req = $request->all();
        $data = Item::find($id);
        $data->update([
            'stok' => ($data->stok + $req['stock_add'])
        ]);
        return redirect()->route('items');
    }

    public function delete($id)
    {
        $data = Item::find($id);
        $data->delete();
        return redirect()->route('items');
    }
}
