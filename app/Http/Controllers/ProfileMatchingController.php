<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProfileMatchingResult;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\NilaiIdeal;
use Illuminate\Http\Request;

class ProfileMatchingController extends Controller
{
    public function report()
    {
        $results = ProfileMatchingResult::with('pegawai')->orderByDesc('total_nilai')->get();

        return view('profile_matching.report', compact('results'));
    }
    public function exportPdf()
    {
        $results = ProfileMatchingResult::with('pegawai')->orderByDesc('total_score')->get();
        $pdf = Pdf::loadView('profile_matching.pdf', compact('results'));
        return $pdf->download('laporan_profile_matching.pdf');
    }

    public function calculate()
    {
        $pegawais = Pegawai::all();
        $kriterias = Kriteria::all()->keyBy('id');
        $nilaiIdeals = NilaiIdeal::all()->keyBy('kriteria_id');

        $results = [];

        foreach ($pegawais as $pegawai) {
            $nilaiAktuals = $pegawai->nilaiAktual ? $pegawai->nilaiAktual->keyBy('kriteria_id') : collect();
            $cfTotal = 0;
            $cfCount = 0;
            $sfTotal = 0;
            $sfCount = 0;

            foreach ($nilaiIdeals as $kriteria_id => $ideal) {
                $actual = isset($nilaiAktuals[$kriteria_id]) ? $nilaiAktuals[$kriteria_id]->nilai : 0;
                $gap = $actual - $ideal->nilai_ideal;
                $bobotGap = $this->konversiGap($gap);
                $bobotAHP = $kriterias[$kriteria_id]->bobot;

                $nilai = $bobotGap * $bobotAHP;

                if ($ideal->tipe_faktor == 'core') {
                    $cfTotal += $nilai;
                    $cfCount++;
                } else {
                    $sfTotal += $nilai;
                    $sfCount++;
                }
            }

            $cfAverage = $cfCount ? $cfTotal / $cfCount : 0;
            $sfAverage = $sfCount ? $sfTotal / $sfCount : 0;

            $totalScore = ($cfAverage * 0.6) + ($sfAverage * 0.4);

            ProfileMatchingResult::updateOrCreate(
                ['pegawai_id' => $pegawai->id],
                ['total_score' => $totalScore]
            );

            $results[] = [
                'pegawai' => $pegawai,
                'total_score' => $totalScore,
            ];
        }

        return redirect()->route('profile-matching.report')->with('success', 'Perhitungan selesai!');
    }

    private function konversiGap($gap)
    {
        $map = [
            0 => 5,
            1 => 4.5,
            -1 => 4,
            2 => 3.5,
            -2 => 3,
            3 => 2.5,
            -3 => 2,
            4 => 1.5,
            -4 => 1,
        ];
        return $map[$gap] ?? 1;
    }

}
