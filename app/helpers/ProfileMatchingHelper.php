<?php

namespace App\Helpers;

class ProfileMatchingHelper
{
    // Tabel konversi GAP ke Bobot
    private static $gapWeight = [
        0  => 5.0,
        1  => 4.5,
        -1 => 4.0,
        2  => 3.5,
        -2 => 3.0,
        3  => 2.5,
        -3 => 2.0,
        4  => 1.5,
        -4 => 1.0,
    ];

    /**
     * Hitung nilai akhir kandidat berdasarkan GAP dan bobot AHP
     *
     * @param array $kandidat // contoh: ['K1' => 4, 'K2' => 3, ..., 'K5' => 5]
     * @param array $nilaiIdeal // contoh: ['K1' => 5, 'K2' => 4, ..., 'K5' => 5]
     * @param array $bobotAHP // hasil dari AHP: ['K1' => 0.25, 'K2' => 0.2, ..., 'K5' => 0.1]
     * @return float skor akhir
     */
    public static function hitungSkorAkhir(array $kandidat, array $nilaiIdeal, array $bobotAHP): float
    {
        $totalSkor = 0;

        foreach ($kandidat as $kodeKriteria => $nilaiKandidat) {
            $ideal = $nilaiIdeal[$kodeKriteria] ?? 0;
            $gap = $nilaiKandidat - $ideal;
            $bobotGap = self::$gapWeight[$gap] ?? 1.0;

            $bobotKriteria = $bobotAHP[$kodeKriteria] ?? 0;
            $totalSkor += $bobotGap * $bobotKriteria;
        }

        return round($totalSkor, 4);
    }
}
