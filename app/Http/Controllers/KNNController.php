<?php

namespace App\Http\Controllers;

use App\Helpers\knnfungsi;
use App\Models\Item;
use App\Models\KNN;
use Illuminate\Http\Request;

class KNNController extends Controller
{
    public function knnview()
    {
        $datas = KNN::with("item")->get();
        // dd($datas[0]);
        return view('item.knn', compact(['datas']));
    }

    public function knn()
    {
        $knnfun = new knnfungsi();
        $data = KNN::all()->groupBy('id_item');

        $new = [];
        foreach ($data as $dt) {
            $item = Item::find($dt[0]->id_item);
            $new[$dt[0]->id_item] = [
                'id' => $dt[0]->id_item,
                'item' => $item,
                'jumlah' => 0.0,
                'harga' => 0.0,
                'total' => 0.0,
            ];

            foreach ($dt as $d) {
                $new[$dt[0]->id_item]['jumlah'] += $d->jumlah;
                $new[$dt[0]->id_item]['harga'] = $d->harga;
                $new[$dt[0]->id_item]['total'] += $d->total;
            }
        }
        // dd($new);

        $data = $new;

        // Preprocess data
        $data = $knnfun->preprocessData($data);
        // Split data into training and testing sets
        // $XY = $knnfun->splitData($data);
        list($X_train, $X_test, $y_train, $y_test) = $knnfun->splitData($data);

        $k = 5;
        // Train the KNN model
        $knn = $knnfun->trainKNN($X_train, $y_train, $k);
        // dd($data[0]);

        // Evaluate the KNN model
        $mse = $knnfun->evaluateKNN($knn, $X_test, $y_test);
        $y_pred = $knn->predict($X_test);
        $mae = $knnfun->akurasiMAE($y_test, $y_pred);
        $per = $knnfun->akurasiPersen($y_test, $y_pred);
        // dd($per);
        // Predict future sales for all data
        $y_pred_all = $knnfun->predictFutureSales($knn, $data);
        // dd($y_pred_all);
        // Recommend stock replenishment
        $datas = $knnfun->recommendStockReplenishment($data, $y_pred_all);
        return view('item.knnresult', compact(['datas', 'mse', 'mae', 'per']));
    }
}
