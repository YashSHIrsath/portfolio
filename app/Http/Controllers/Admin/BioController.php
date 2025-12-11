<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use Illuminate\Http\Request;

class BioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bios = Bio::orderBy('created_at', 'desc')->get();
        return view('admin.bios.index', compact('bios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Bio::create($validated);

        return redirect()->route('admin.bios.index')
            ->with('success', 'Bio created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bio $bio)
    {
        return view('admin.bios.edit', compact('bio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bio $bio)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $bio->update($validated);

        return redirect()->route('admin.bios.index')
            ->with('success', 'Bio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bio $bio)
    {
        $bio->delete();
        return redirect()->route('admin.bios.index')
            ->with('success', 'Bio deleted successfully.');
    }
}
