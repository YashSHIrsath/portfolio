<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeyValue;
use Illuminate\Http\Request;

class KeyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Filter by type 'stat' for now, or allow filtering in view if we expand usage
        $keyValues = KeyValue::where('type', 'stat')->orderBy('sort_order')->get();
        return view('admin.key_values.index', compact('keyValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.key_values.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'type' => 'required|string|in:stat', // Enforce 'stat' for now
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        KeyValue::create($validated);

        return redirect()->route('admin.key-values.index')
            ->with('success', 'Stat created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KeyValue $keyValue)
    {
        return view('admin.key_values.edit', compact('keyValue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KeyValue $keyValue)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'type' => 'required|string|in:stat',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        $keyValue->update($validated);

        return redirect()->route('admin.key-values.index')
            ->with('success', 'Stat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeyValue $keyValue)
    {
        $keyValue->delete();
        return redirect()->route('admin.key-values.index')
            ->with('success', 'Stat deleted successfully.');
    }
}
