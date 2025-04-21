<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token'); // Hindari menyimpan _token ke database
        Kriteria::create($data);

        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil disimpan!');
    }

    public function edit(Kriteria $kriteria)
    {
        // Add this temporary debug line:


        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|between:0,1',
        ]);

        $kriteria->update($request->only('nama', 'bobot'));

        return redirect()->route('kriteria.index')->with('success', 'Data berhasil diupdate');
    }


    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
