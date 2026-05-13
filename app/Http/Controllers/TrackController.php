<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::all();
        return view('dashboard.tracks.index', compact('tracks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tracks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:tracks,code',
            'name' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Track::create($validatedData);

        return redirect()->route('dashboard.tracks.index')->with('success', 'Rute Hauling berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Track $track)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        return view('dashboard.tracks.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track   )
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255|unique:tracks,code,' . $track->id,
            'name' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $track->update($validatedData);

        return redirect()->route('dashboard.tracks.index')->with('success', 'Rute Hauling berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()->route('dashboard.tracks.index')->with('success', 'Rute Hauling berhasil dihapus.');
    }
}
