<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AHPCalculation;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class AHPController extends Controller
{
    /**
     * Display a listing of AHP calculations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calculations = AHPCalculation::latest()->get();
        return view('ahp.index', compact('calculations'));
    }

    /**
     * Show the form for creating a new AHP calculation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('ahp.create', compact('kriterias'));
    }

    /**
     * Store a newly created AHP calculation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'nama_perhitungan' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);

        // Get all criteria
        $kriterias = Kriteria::all();
        $count = $kriterias->count();

        // Extract matrix from form
        $matrix = [];
        for ($i = 1; $i <= $count; $i++) {
            $row = [];
            for ($j = 1; $j <= $count; $j++) {
                $key = "c{$i}c{$j}";
                if ($request->has($key)) {
                    $row[] = floatval($request->$key);
                } else {
                    // If the key doesn't exist in the request, calculate the reciprocal value
                    $inverseKey = "c{$j}c{$i}";
                    $inverseValue = floatval($request->$inverseKey);
                    $row[] = $inverseValue != 0 ? 1 / $inverseValue : 0;
                }
            }
            $matrix[] = $row;
        }

        // Perform AHP calculation
        $result = $this->calculateAHP($matrix, $count);

        // Prepare weights for each criteria
        $criteriaWeights = array_combine(
            $kriterias->pluck('id')->toArray(),
            $result['priority_vector']
        );

        DB::beginTransaction();
        try {
            // Create AHP calculation record
            $ahpCalculation = AHPCalculation::create([
                'user_id' => auth()->id(),
                'nama' => $request->nama_perhitungan,
                'detail' => $request->detail,
                'consistency_ratio' => $result['consistency_ratio'],
                'matrix_data' => json_encode($matrix),
                'created_at' => now(),
            ]);

            // Update criteria weights
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

    /**
     * Calculate AHP weights and consistency ratio
     *
     * @param array $matrix Comparison matrix
     * @param int $n Size of matrix
     * @return array Result containing priority vector and consistency ratio
     */
    private function calculateAHP($matrix, $n)
    {
        // Step 1: Calculate column sums
        $columnSums = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $columnSums[$j] += $matrix[$i][$j];
            }
        }

        // Step 2: Normalize the matrix
        $normalizedMatrix = [];
        for ($i = 0; $i < $n; $i++) {
            $row = [];
            for ($j = 0; $j < $n; $j++) {
                $row[] = $columnSums[$j] != 0 ? $matrix[$i][$j] / $columnSums[$j] : 0;
            }
            $normalizedMatrix[] = $row;
        }

        // Step 3: Calculate priority vector (criteria weights)
        $priorityVector = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $normalizedMatrix[$i][$j];
            }
            $priorityVector[] = $sum / $n;
        }

        // Step 4: Calculate weighted sum values
        $weightedSumValues = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $priorityVector[$j];
            }
            $weightedSumValues[] = $sum;
        }

        // Step 5: Calculate consistency vector
        $consistencyVector = [];
        for ($i = 0; $i < $n; $i++) {
            $consistencyVector[] = $priorityVector[$i] != 0 ? $weightedSumValues[$i] / $priorityVector[$i] : 0;
        }

        // Step 6: Calculate lambda max (average of consistency vector)
        $lambdaMax = array_sum($consistencyVector) / $n;

        // Step 7: Calculate Consistency Index (CI)
        $ci = ($lambdaMax - $n) / ($n - 1);

        // Step 8: Calculate Consistency Ratio (CR)
        // Random consistency index values (RI)
        $ri = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $cr = $n >= 2 ? $ci / $ri[$n - 1] : 0;

        return [
            'priority_vector' => $priorityVector,
            'consistency_ratio' => $cr,
            'lambda_max' => $lambdaMax,
        ];
    }

    /**
     * Display the specified AHP calculation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calculation = AHPCalculation::findOrFail($id);
        $kriterias = Kriteria::all();

        // Decode matrix data
        $matrixData = json_decode($calculation->matrix_data, true);

        return view('ahp.show', compact('calculation', 'kriterias', 'matrixData'));
    }

    /**
     * Remove the specified AHP calculation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calculation = AHPCalculation::findOrFail($id);
        $calculation->delete();

        return redirect()->route('ahp.index')
            ->with('success', 'AHP calculation deleted successfully');
    }
}