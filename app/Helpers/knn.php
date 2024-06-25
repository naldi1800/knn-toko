<?php

namespace App\Helpers;
class knn
{
    private $X_train;
    private $y_train;
    private $k;

    public function __construct($X_train, $y_train, $k)
    {
        $this->X_train = $X_train;
        $this->y_train = $y_train;
        $this->k = $k;
    }

    public function predict($X_test)
    {
        $y_pred = [];
        foreach ($X_test as $x) {
            $distances = [];
            for ($i = 0; $i < count($this->X_train); $i++) {
                $distance = $this->calculateDistance($x, $this->X_train[$i]);
                $distances[] = [$distance, $i];
            }
            usort($distances, function ($a, $b) {
                return $a[0] <=> $b[0];
            });
            $k_nearest_neighbors = [];
            for ($i = 0; $i < $this->k; $i++) {
                $k_nearest_neighbors[] = $this->y_train[$distances[$i][1]];
            }
            $y_pred[] = $this->calculateAverage($k_nearest_neighbors);
        }
        return $y_pred;
    }

    private function calculateDistance($x1, $x2)
    {
        $distance = 0;
        for ($i = 0; $i < count($x1); $i++) {
            $distance += pow($x1[$i] - $x2[$i], 2);
        }
        return sqrt($distance);
    }

    private function calculateAverage($values)
    {
        $sum = 0;
        foreach ($values as $value) {
            // echo($value);
            $sum += $value[0];
        }
        return $sum / count($values);
    }
}




