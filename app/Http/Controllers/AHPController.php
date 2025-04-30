<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AHPCalculation;
use App\Models\NilaiAktual;
use App\Models\NilaiIdeal;
use App\Models\Pegawai;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class AHPController extends Controller
{
    public function index()
    {
        $calculations = AHPCalculation::latest()->get();
        return view('ahp.index', compact('calculations'));
    }

    

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('ahp.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perhitungan' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);

        $kriterias = Kriteria::all();
        $count = $kriterias->count();

        $matrix = [];
        for ($i = 1; $i <= $count; $i++) {
            $row = [];
            for ($j = 1; $j <= $count; $j++) {
                $key = "c{$i}c{$j}";
                if ($request->has($key)) {
                    $row[] = floatval($request->$key);
                } else {
                    $inverseKey = "c{$j}c{$i}";
                    $inverseValue = floatval($request->$inverseKey);
                    $row[] = $inverseValue != 0 ? 1 / $inverseValue : 0;
                }
            }
            $matrix[] = $row;
        }

        $result = $this->calculateAHP($matrix, $count);

        $criteriaWeights = array_combine(
            $kriterias->pluck('id')->toArray(),
            $result['priority_vector']
        );

        DB::beginTransaction();
        try {
            $ahpCalculation = AHPCalculation::create([
                'user_id' => auth()->id(),
                'nama' => $request->nama_perhitungan,
                'detail' => $request->detail,
                'consistency_ratio' => $result['consistency_ratio'],
                'matrix_data' => json_encode($matrix),
                'created_at' => now(),
            ]);

            foreach ($criteriaWeights as $criteriaId => $weight) {
                Kriteria::where('id', $criteriaId)->update(['bobot' => $weight]);
            }

            DB::commit();
            return redirect()->route('ahp.index')
                ->with('success', 'AHP calculation created successfully. Consistency Ratio: ' . number_format($result['consistency_ratio'], 4));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Error creating AHP calculation: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function calculateAHP($matrix, $n)
    {
        $columnSums = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $columnSums[$j] += $matrix[$i][$j];
            }
        }

        $normalizedMatrix = [];
        for ($i = 0; $i < $n; $i++) {
            $row = [];
            for ($j = 0; $j < $n; $j++) {
                $row[] = $columnSums[$j] != 0 ? $matrix[$i][$j] / $columnSums[$j] : 0;
            }
            $normalizedMatrix[] = $row;
        }

        $priorityVector = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $normalizedMatrix[$i][$j];
            }
            $priorityVector[] = $sum / $n;
        }

        $weightedSumValues = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $priorityVector[$j];
            }
            $weightedSumValues[] = $sum;
        }

        $consistencyVector = [];
        for ($i = 0; $i < $n; $i++) {
            $consistencyVector[] = $priorityVector[$i] != 0 ? $weightedSumValues[$i] / $priorityVector[$i] : 0;
        }

        $lambdaMax = array_sum($consistencyVector) / $n;
        $ci = ($lambdaMax - $n) / ($n - 1);
        $ri = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $cr = $n >= 2 ? $ci / $ri[$n - 1] : 0;

        return [
            'priority_vector' => $priorityVector,
            'consistency_ratio' => $cr,
            'lambda_max' => $lambdaMax,
        ];
    }

    public function show($id)
    {
        $calculation = AHPCalculation::findOrFail($id);
        $kriterias = Kriteria::all();
        $matrixData = json_decode($calculation->matrix_data, true);
        return view('ahp.show', compact('calculation', 'kriterias', 'matrixData'));
    }

    public function destroy($id)
    {
        $calculation = AHPCalculation::findOrFail($id);
        $calculation->delete();

        return redirect()->route('ahp.index')
            ->with('success', 'AHP calculation deleted successfully');
    }
}