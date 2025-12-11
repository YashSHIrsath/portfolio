<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatStack;
use Illuminate\Http\Request;

class CatStackController extends Controller
{
    public function index()
    {
        $stacks = CatStack::orderBy('sort_order')->get();
        return view('admin.cat_stacks.index', compact('stacks'));
    }

    public function create()
    {
        return view('admin.cat_stacks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'values' => 'required|string', // Comma separated input
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Process values from comma-separated string to array
        $valuesArray = array_map('trim', explode(',', $request->input('values')));
        $valuesArray = array_filter($valuesArray); // Remove empty values

        $validated['values'] = array_values($valuesArray);
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        CatStack::create($validated);

        return redirect()->route('admin.cat-stacks.index')
            ->with('success', 'Stack created successfully.');
    }

    public function edit(CatStack $catStack)
    {
        return view('admin.cat_stacks.edit', compact('catStack'));
    }

    public function update(Request $request, CatStack $catStack)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255',
            'values' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $valuesArray = array_map('trim', explode(',', $request->input('values')));
        $valuesArray = array_filter($valuesArray);

        $validated['values'] = array_values($valuesArray);
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        $catStack->update($validated);

        return redirect()->route('admin.cat-stacks.index')
            ->with('success', 'Stack updated successfully.');
    }

    public function destroy(CatStack $catStack)
    {
        $catStack->delete();
        return redirect()->route('admin.cat-stacks.index')
            ->with('success', 'Stack deleted successfully.');
    }
}
