<?php

namespace App\Http\Controllers;

use App\Models\Haul;
use App\Models\Owner;
use App\Models\Partner;
use App\Models\Period;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HaulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hauls = Haul::with(['owner', 'partner', 'track', 'period', 'user'])->latest()->get();
        return view('dashboard.hauls.index', compact('hauls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Owner::all();
        $partners = Partner::all();
        $tracks = Track::all();
        $periods = Period::where('is_active', true)->get();
        $users = User::all();

        return view('dashboard.hauls.create', compact('owners', 'partners', 'tracks', 'periods', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tonage' => 'required|numeric|min:0',
            'photo_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'track_id' => 'required|exists:tracks,id',
            'period_id' => 'required|exists:periods,id',
        ]);

        $user = Auth::user();

        // ambil partner dari user login
        $partner = Partner::findOrFail($user->partner_id);

        // ambil owner dari partner
        $owner = Owner::findOrFail($partner->owner_id);

        // upload foto jika ada
        $photoPath = null;

        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo_path')->store('hauls', 'public');
        }

        Haul::create([
            'tonage' => $request->tonage,
            'photo_path' => $photoPath,

            'owner_id' => $owner->id,
            'partner_id' => $partner->id,

            'track_id' => $request->track_id,
            'period_id' => $request->period_id,

            'user_id' => $user->id,
        ]);

        return redirect()
            ->route('dashboard.hauls.create')
            ->with('success', 'Data hauling berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Haul $haul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Haul $haul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Haul $haul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Haul $haul)
    {
        //
    }
}
