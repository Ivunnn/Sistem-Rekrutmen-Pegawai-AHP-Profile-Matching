<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas;
use Auth;

class BerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::where('user_id', Auth::id())->first();
        return view('berkas.index', compact('berkas'));
    }

    public function create()
    {
        
        return view('berkas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bagian' => 'required|in:sales,digital marketing',
            'pendidikan' => 'required|string',
            'sertifikat_pendukung' => 'nullable|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('cv', 'public');

        Berkas::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'bagian' => $request->bagian,
            'pendidikan' => $request->pendidikan,
            'sertifikat_pendukung' => $request->sertifikat_pendukung,
            'cv' => $cvPath,
        ]);

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diisi.');
    }
}

