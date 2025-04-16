<?php

namespace App\Helpers;

class AHPHelper
{
    public static function calculate($matrix)
    {
        $n = count($matrix);

        // 1. Hitung total tiap kolom
        $columnSums = array_fill(0, $n, 0);
        foreach ($matrix as $row) {
            foreach ($row as $j => $val) {
                $columnSums[$j] += $val;
            }
        }

        // 2. Normalisasi matriks dan hitung bobot (eigen vector)
        $normalized = [];
        $weights = array_fill(0, $n, 0);
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $val) {
                $normalized[$i][$j] = $val / $columnSums[$j];
                $weights[$i] += $normalized[$i][$j];
            }
            $weights[$i] /= $n;
        }

        // 3. Hitung lambda max
        $lambdaMax = 0;
        foreach ($matrix as $i => $row) {
            $rowSum = 0;
            foreach ($row as $j => $val) {
                $rowSum += $val * $weights[$j];
            }
            $lambdaMax += $rowSum / $weights[$i];
        }
        $lambdaMax /= $n;

        // 4. Hitung CI (Consistency Index)
        $CI = ($lambdaMax - $n) / ($n - 1);

        // 5. Hitung CR (Consistency Ratio)
        $RI = self::getRI($n);
        $CR = $RI == 0 ? 0 : $CI / $RI;

        return [
            'weights' => $weights,
            'lambda_max' => $lambdaMax,
            'ci' => $CI,
            'cr' => $CR,
            'consistent' => $CR < 0.1,
        ];
    }

    // Nilai Random Index dari tabel
    private static function getRI($n)
    {
        $RIValues = [
            1 => 0.00,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59,
        ];

        return $RIValues[$n] ?? 1.59;
    }
}
