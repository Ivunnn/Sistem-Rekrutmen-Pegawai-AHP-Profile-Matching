<?php

namespace App\Http\Controllers;

use App\Models\GapBobot;
use Illuminate\Http\Request;

class GapBobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gapBobots = GapBobot::orderBy('selisih')->get();
        return view('gap_bobot.index', compact('gapBobots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gap_bobot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'selisih' => 'required|integer|unique:gap_bobots',
            'bobot' => 'required|numeric|between:0,5',
            'keterangan' => 'required|string|max:255',
        ]);

        GapBobot::create($request->all());

        return redirect()->route('gap-bobot.index')
            ->with('success', 'Bobot GAP berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GapBobot  $gapBobot
     * @return \Illuminate\Http\Response
     */
    public function edit(GapBobot $gapBobot)
    {
        return view('gap_bobot.edit', compact('gapBobot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GapBobot  $gapBobot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GapBobot $gapBobot)
    {
        $request->validate([
            'selisih' => 'required|integer|unique:gap_bobots,selisih,' . $gapBobot->id,
            'bobot' => 'required|numeric|between:0,5',
            'keterangan' => 'required|string|max:255',
        ]);

        $gapBobot->update($request->all());

        return redirect()->route('gap-bobot.index')
            ->with('success', 'Bobot GAP berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GapBobot  $gapBobot
     * @return \Illuminate\Http\Response
     */
    public function destroy(GapBobot $gapBobot)
    {
        $gapBobot->delete();

        return redirect()->route('gap-bobot.index')
            ->with('success', 'Bobot GAP berhasil dihapus.');
    }
}