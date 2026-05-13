<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return view('dashboard.partners.index', compact('partners'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Owner::all();
        return view('dashboard.partners.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'legal_name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email',
            'phone' => 'required|string|max:20',
            'tax_identity_number' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|string',
            'owner_id' => 'required|exists:owners,id',
        ]);

        Partner::create($validatedData);

        return redirect()->route('dashboard.partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        $owners = Owner::all();
        return view('dashboard.partners.edit', compact('partner', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validatedData = $request->validate([
            'legal_name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email,' . $partner->id,
            'phone' => 'required|string|max:20',
            'tax_identity_number' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|string',
            'owner_id' => 'required|exists:owners,id',
        ]);

        $partner->update($validatedData);

        return redirect()->route('dashboard.partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('dashboard.partners.index')->with('success', 'Partner berhasil dihapus.');
    }

    public function trash()
    {
        $partners = Partner::onlyTrashed()->get();
        return view('dashboard.partners.trash', compact('partners'));
    }

    public function restore($id)
    {
        $partner = Partner::withTrashed()->findOrFail($id);
        $partner->restore();

        return back()->with('success', 'Partner berhasil direstore.');
    }

    public function forceDelete($id)
    {
        $partner = Partner::withTrashed()->findOrFail($id);
        $partner->forceDelete();

        return back()->with('success', 'Partner berhasil dihapus permanen.');
    }
}
