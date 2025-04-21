<?php
namespace App\Http\Controllers;

use App\Models\NilaiIdeal;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class NilaiIdealController extends Controller
{
    public function index()
    {
        $nilaiIdeals = NilaiIdeal::with('kriteria')->get();
        return view('nilai_ideal.index', compact('nilaiIdeals'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('nilai_ideal.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        foreach ($request->nilai_ideal as $data) {
            NilaiIdeal::create($data);
        }

        return redirect()->route('nilai-ideal.index')->with('success', 'Nilai ideal berhasil disimpan.');
    }

    public function edit($id)
    {
        $nilaiIdeal = NilaiIdeal::with('kriteria')->findOrFail($id);
        return view('nilai_ideal.edit', compact('nilaiIdeal'));
    }

    public function update(Request $request, $id)
    {
        $nilaiIdeal = NilaiIdeal::findOrFail($id);
        $nilaiIdeal->update([
            'nilai_ideal' => $request->nilai_ideal,
            'tipe_faktor' => $request->tipe_faktor,
        ]);

        return redirect()->route('nilai-ideal.index')->with('success', 'Nilai ideal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilaiIdeal = NilaiIdeal::findOrFail($id);
        $nilaiIdeal->delete();

        return redirect()->route('nilai-ideal.index')->with('success', 'Nilai ideal berhasil dihapus.');
    }
}
