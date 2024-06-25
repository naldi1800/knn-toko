<?php
namespace App\Helpers;

class knnfungsi
{
    function preprocessData($data)
    {
        // Convert numerical columns to float   
        // $newdata = [];
        // echo("<br>");
        // echo("<br>");
        // echo("<br>");
        // echo("<br>");
        // var_dump($data[81]);
        foreach ($data as $row) {
            // var_dump($row);
            $row = [
                'id' => $row['id'],
                'item' => $row['item'],
                'jumlah' => (float) $row['jumlah'],
                'harga' => (float) $row['harga'],
                'total' => (float) $row['total'],
            ];

            $newdata[] = $row;
        }
        // dd($newdata);

        return $newdata;
    }

    function splitData($data)
    {
        // Split data into training and testing sets (80% training, 20% testing)
        $X = [];
        $y = [];
        foreach ($data as $row) {
            $X[] = [$row['jumlah'] * $row['harga']];
            $y[] = [$row['total']];
        }
        $X_train = [];
        $X_test = [];
        $y_train = [];
        $y_test = [];
        $trainSize = count($data) * 0.8;
        for ($i = 0; $i < count($data); $i++) {
            if ($i < $trainSize) {
                $X_train[] = $X[$i];
                $y_train[] = $y[$i];
            } else {
                $X_test[] = $X[$i];
                $y_test[] = $y[$i];
            }
        }
        return [$X_train, $X_test, $y_train, $y_test];
    }

    function trainKNN($X_train, $y_train, $k)
    {
        // Train the KNN model with k=5 neighbors
        require 'KNN.php';

        
        $knn = new KNN($X_train, $y_train, $k);
        return $knn;
    }
  
    function evaluateKNN($knn, $X_test, $y_test)
    {
        // Evaluate the KNN model using root mean squared error (RMSE)
        $y_pred = $knn->predict($X_test);
        $rmse = 0;
        // dd($y_pred);
        for ($i = 0; $i < count($y_pred); $i++) {
            $rmse += pow($y_test[$i][0] - $y_pred[$i], 2);
            // break;
            // exit;
        }
        $rmse /= count($y_pred);
        $rmse = sqrt($rmse);
        // var_dump($y_test);    
        // exit;
        return $rmse;
    }

    function akurasiMAE($y_true, $y_pred)
    {
        $mae = 0;
        for ($i = 0; $i < count($y_true); $i++) {
            $mae += abs($y_true[$i][0] - $y_pred[$i]);
        }
        $mae /= count($y_true);
        return $mae;
    }

    function akurasiPersen($y_true, $y_pred)
    {
        $mape = 0;
        for ($i = 0; $i < count($y_true); $i++) {
            $actual = $y_true[$i][0];
            $predicted = $y_pred[$i];
            if ($actual != 0) {
                $mape += abs(($actual - $predicted) / $actual);
            }
        }
        $mape /= count($y_true);
        $accuracy = (1 - $mape) * 100; // Convert MAPE to accuracy percentage
        return number_format($accuracy, 2) . '%';
    }

    function predictFutureSales($knn, $data)
    {
        // Predict future sales for all data
        $X_all = [];
        foreach ($data as $row) {
            $X_all[] = [$row['jumlah'] * $row['harga']];
        }
        $y_pred_all = $knn->predict($X_all);
        return $y_pred_all;
    }
    function recommendStockReplenishment($data, $y_pred_all)
    {
        foreach ($data as $key => &$row) {
            $row['total_masa_depan'] = $y_pred_all[$key];
            $row['stok_saat_ini'] = $row['item']->stok;
            // var_dump($row['total_masa_depan'] . " === " . ($row['stok_saat_ini'] * $row['item']->harga));// Assume current stock is unknown
        }
        $rekomendasi = [];
        foreach ($data as $row) {
            // if ($row['total_masa_depan'] > ($row['stok_saat_ini'] * $row['item']->harga)) {
                $rekomendasi[] = $row;
            // }
        }
        return $rekomendasi;
    }
}