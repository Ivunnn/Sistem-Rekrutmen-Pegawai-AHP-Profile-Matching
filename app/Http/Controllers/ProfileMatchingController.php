<?php

namespace App\Http\Controllers;

use App\Models\ProfileMatching;
use App\Models\Pegawai;
use App\Models\Kriteria;
use App\Models\NilaiIdeal;
use App\Models\NilaiAktual;
use App\Models\GapBobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ProfileMatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cek apakah ada data nilai ideal
        $nilaiIdealCount = NilaiIdeal::count();
        if ($nilaiIdealCount == 0) {
            return redirect()->route('nilai-ideal.create')
                ->with('warning', 'Harap tentukan nilai ideal terlebih dahulu.');
        }

        // Cek apakah ada data kriteria dengan bobot AHP
        $kriteriaWithBobot = Kriteria::whereNotNull('bobot')->where('bobot', '>', 0)->count();
        if ($kriteriaWithBobot == 0) {
            return redirect()->route('ahp.create')
                ->with('warning', 'Harap lakukan perhitungan AHP terlebih dahulu untuk mendapatkan bobot kriteria.');
        }

        // Ambil semua pegawai yang memiliki nilai aktual
        $pegawaiIds = NilaiAktual::distinct('pegawai_id')->pluck('pegawai_id');
        $pegawais = Pegawai::whereIn('id', $pegawaiIds)->get();
        
        // Hitung profile matching untuk semua pegawai
        $hasil = $this->calculateProfileMatching();
        
        return view('profile_matching.index', compact('hasil', 'pegawais'));
    }

    /**
     * Calculate profile matching for all employees
     *
     * @return array
     */
    private function calculateProfileMatching()
    {
        // Get all necessary data
        $pegawais = Pegawai::all();
        $kriterias = Kriteria::all();
        $nilaiIdeals = NilaiIdeal::all()->keyBy('kriteria_id');
        
        $results = [];
        
        // Process each employee
        foreach ($pegawais as $pegawai) {
            // Get actual values for this employee
            $nilaiAktuals = NilaiAktual::where('pegawai_id', $pegawai->id)
                ->get()
                ->keyBy('kriteria_id');
                
            // If no values yet, skip this employee
            if ($nilaiAktuals->isEmpty()) {
                continue;
            }
            
            $gaps = [];
            $bobotGaps = [];
            $cfValues = [];
            $sfValues = [];
            $criteriaResults = [];
            
            // Process each criteria
            foreach ($kriterias as $kriteria) {
                // Check if we have both ideal and actual values
                if (isset($nilaiIdeals[$kriteria->id]) && isset($nilaiAktuals[$kriteria->id])) {
                    // Calculate GAP
                    $nilaiIdeal = $nilaiIdeals[$kriteria->id]->nilai_ideal;
                    $nilaiAktual = $nilaiAktuals[$kriteria->id]->nilai;
                    $gap = $nilaiAktual - $nilaiIdeal;
                    
                    // Get weight for this GAP
                    $gapBobot = GapBobot::where('selisih', $gap)->first();
                    if (!$gapBobot) {
                        // Handle case where gap is outside our predefined range
                        $bobotValue = ($gap > 0) ? 1.5 : 1.0; // Default values for extreme gaps
                    } else {
                        $bobotValue = $gapBobot->bobot;
                    }
                    
                    // Store results for this criteria
                    $criteriaResults[$kriteria->id] = [
                        'kriteria_nama' => $kriteria->nama,
                        'nilai_ideal' => $nilaiIdeal,
                        'nilai_aktual' => $nilaiAktual,
                        'gap' => $gap,
                        'bobot_gap' => $bobotValue,
                        'tipe_faktor' => $nilaiIdeals[$kriteria->id]->tipe_faktor
                    ];
                    
                    // Separate into Core Factor and Secondary Factor
                    if ($nilaiIdeals[$kriteria->id]->tipe_faktor === 'core') {
                        $cfValues[$kriteria->id] = $bobotValue;
                    } else {
                        $sfValues[$kriteria->id] = $bobotValue;
                    }
                }
            }
            
            // Calculate CF and SF values
            $nilaiCF = !empty($cfValues) ? array_sum($cfValues) / count($cfValues) : 0;
            $nilaiSF = !empty($sfValues) ? array_sum($sfValues) / count($sfValues) : 0;
            
            // Calculate total value (60% CF + 40% SF)
            $nilaiTotal = (0.6 * $nilaiCF) + (0.4 * $nilaiSF);
            
            // Calculate final value with AHP weights
            $nilaiAkhir = 0;
            foreach ($criteriaResults as $kriteriaId => $result) {
                $kriteria = $kriterias->firstWhere('id', $kriteriaId);
                $nilaiAkhir += $result['bobot_gap'] * $kriteria->bobot;
            }
            
            // Store results for this employee
            $results[$pegawai->id] = [
                'pegawai' => $pegawai,
                'detail_perhitungan' => $criteriaResults,
                'nilai_cf' => $nilaiCF,
                'nilai_sf' => $nilaiSF,
                'nilai_total' => $nilaiTotal,
                'nilai_akhir' => $nilaiAkhir
            ];
        }
        
        // Sort by final score (descending)
        uasort($results, function ($a, $b) {
            return $b['nilai_akhir'] <=> $a['nilai_akhir'];
        });
        
        // Add ranking
        $rank = 1;
        foreach ($results as &$result) {
            $result['ranking'] = $rank++;
            
            // Save result to database
            ProfileMatching::updateOrCreate(
                ['pegawai_id' => $result['pegawai']->id],
                [
                    'hasil_perhitungan' => $result['detail_perhitungan'],
                    'nilai_cf' => $result['nilai_cf'],
                    'nilai_sf' => $result['nilai_sf'],
                    'nilai_total' => $result['nilai_total'],
                    'nilai_akhir' => $result['nilai_akhir'],
                    'ranking' => $result['ranking']
                ]
            );
        }
        
        return $results;
    }

    /**
     * Show detailed calculation for a specific employee
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $profileMatching = ProfileMatching::where('pegawai_id', $id)->first();
        
        if (!$profileMatching) {
            // Recalculate if not found
            $this->calculateProfileMatching();
            $profileMatching = ProfileMatching::where('pegawai_id', $id)->first();
            
            if (!$profileMatching) {
                return redirect()->route('profile-matching.index')
                    ->with('error', 'Data nilai aktual untuk pegawai ini belum lengkap.');
            }
        }
        
        $kriterias = Kriteria::all();
        $nilaiIdeals = NilaiIdeal::all()->keyBy('kriteria_id');
        
        return view('profile_matching.show', compact('pegawai', 'profileMatching', 'kriterias', 'nilaiIdeals'));
    }

    /**
     * Generate PDF report
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePdf()
    {
        $hasil = $this->calculateProfileMatching();
        $kriterias = Kriteria::all();
        
        $pdf = PDF::loadView('profile_matching.pdf', compact('hasil', 'kriterias'));
        return $pdf->download('hasil-profile-matching.pdf');
    }
}