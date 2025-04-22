<?php

namespace App\Http\Controllers;

use App\Models\NilaiAktual;
use App\Models\Pegawai;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class NilaiAktualController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all(['id', 'name', 'bagian_dilamar']);
        return view('nilai_aktual.index', compact('pegawais'));
    }

    public function show($pegawai_id)
    {
        $pegawai = Pegawai::findOrFail($pegawai_id);
        $kriterias = Kriteria::all();
        $nilai_aktuals = NilaiAktual::where('pegawai_id', $pegawai_id)->get()->keyBy('kriteria_id');

        return view('nilai_aktual.show', compact('pegawai', 'kriterias', 'nilai_aktuals'));
    }

    public function edit($pegawai_id)
    {
        $pegawai = Pegawai::findOrFail($pegawai_id);
        $kriterias = Kriteria::all();
        $nilai_aktual = NilaiAktual::where('pegawai_id', $pegawai_id)->pluck('nilai', 'kriteria_id')->toArray();

        return view('nilai_aktual.edit', compact('pegawai', 'kriterias', 'nilai_aktual'));
    }

    public function update(Request $request, $pegawai_id)
    {
        foreach ($request->kriteria as $kriteria_id => $nilai) {
            NilaiAktual::updateOrCreate(
                ['pegawai_id' => $pegawai_id, 'kriteria_id' => $kriteria_id],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('nilai-aktual.show', $pegawai_id)->with('success', 'Nilai aktual berhasil diperbarui!');
    }
}
