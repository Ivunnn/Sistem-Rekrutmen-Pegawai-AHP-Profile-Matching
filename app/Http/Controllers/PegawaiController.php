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
            'name' => 'required',
            'bagian_dilamar' => 'required|string|max:255',
            'pendidikan' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'sertifikasi_pendukung' => 'nullable|string',
            'kemampuan' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'name',
            'bagian_dilamar',
            'pendidikan',
            'pengalaman_kerja',
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
            'name' => 'required|string|max:255',
            'bagian_dilamar' => 'required|string|max:255',
            'pendidikan' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'sertifikasi_pendukung' => 'nullable|string',
            'kemampuan' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'name',
            'bagian_dilamar',
            'pendidikan',
            'pengalaman_kerja',
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

    // Tampilkan data pelamar
    public function berkasIndex()
    {
        $pelamar = Pegawai::latest()->first(); // ambil data terbaru satu
        return view('berkas.index', compact('pelamar'));
    }

    // Tampilkan form input
    public function berkasCreate()
    {
        return view('berkas.create');
    }

    // Simpan data pelamar
    public function berkasStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bagian_dilamar' => 'required|in:sales,digital marketing',
            'pendidikan' => 'required|string|max:255',
            'sertifikasi_pendukung' => 'nullable|string|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only(['name', 'bagian_dilamar', 'pendidikan', 'sertifikasi_pendukung']);

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/cv', $filename);
            $data['cv'] = $filename;
        }

        Pegawai::create($data);

        return redirect()->route('berkas.index')->with('success', 'Data pelamar berhasil disimpan.');
    }

    // In PegawaiController.php

    // For candidate to view their own application
    public function myApplication()
    {
        $user = auth()->user();
        $pegawai = Pegawai::where('user_id', $user->id)->first();

        if (!$pegawai) {
            // Create a blank application if none exists
            $pegawai = Pegawai::create([
                'name' => $user->name,
                'user_id' => $user->id,
                'bagian_dilamar' => 'Belum ditentukan',
            ]);
        }

        return view('pegawai.my-application', compact('pegawai'));
    }

    // For candidate to edit their own application
    public function editMyApplication()
    {
        $user = auth()->user();
        $pegawai = Pegawai::where('user_id', $user->id)->firstOrFail();

        return view('pegawai.edit-my-application', compact('pegawai'));
    }

    // For candidate to update their own application
    public function updateMyApplication(Request $request)
    {
        $user = auth()->user();
        $pegawai = Pegawai::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'bagian_dilamar' => 'required|string|max:255',
            'pendidikan' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'sertifikasi_pendukung' => 'nullable|string',
            'kemampuan' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'bagian_dilamar',
            'pendidikan',
            'pengalaman_kerja',
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

        return redirect()->route('pegawai.my-application')->with('success', 'Data pelamar berhasil diperbarui.');
    }
}