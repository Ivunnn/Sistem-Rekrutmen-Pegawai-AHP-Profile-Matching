<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::latest()->paginate(10);
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_peserta' => 'required|unique:pegawais',
            'name' => 'required',
            'bagian_dilamar' => 'required|string|max:255',
            'pendidikan' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'wawancara' => 'nullable|string',
            'sertifikasi_pendukung' => 'nullable|string',
            'kemampuan' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'no_peserta',
            'name',
            'bagian_dilamar',
            'pendidikan',
            'pengalaman_kerja',
            'wawancara',
            'sertifikasi_pendukung',
            'kemampuan',
        ]);

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cv', $filename);
            $data['cv'] = $filename;
        }

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'no_peserta' => 'required|unique:pegawais,no_peserta,' . $pegawai->id,
            'name' => 'required|string|max:255',
            'bagian_dilamar' => 'required|string|max:255',
            'pendidikan' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'wawancara' => 'nullable|string',
            'sertifikasi_pendukung' => 'nullable|string',
            'kemampuan' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'no_peserta',
            'name',
            'bagian_dilamar',
            'pendidikan',
            'pengalaman_kerja',
            'wawancara',
            'sertifikasi_pendukung',
            'kemampuan',
        ]);

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cv', $filename);
            $data['cv'] = $filename;
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
