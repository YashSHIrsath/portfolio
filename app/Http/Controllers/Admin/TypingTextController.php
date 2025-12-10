<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypingText;
use Illuminate\Http\Request;

class TypingTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typingTexts = TypingText::orderBy('sort_order')->get();
        return view('admin.typing_texts.index', compact('typingTexts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.typing_texts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['active'] = $request->has('active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        TypingText::create($validated);

        return redirect()->route('admin.typing-texts.index')
            ->with('success', 'Typing text created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypingText $typingText)
    {
        return view('admin.typing_texts.edit', compact('typingText'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypingText $typingText)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['active'] = $request->has('active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        $typingText->update($validated);

        return redirect()->route('admin.typing-texts.index')
            ->with('success', 'Typing text updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypingText $typingText)
    {
        $typingText->delete();

        return redirect()->route('admin.typing-texts.index')
            ->with('success', 'Typing text deleted successfully.');
    }
}
