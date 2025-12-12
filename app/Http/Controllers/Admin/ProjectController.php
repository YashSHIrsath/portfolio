<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = \App\Models\Project::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');
        
        if ($request->has('tech_stack') && !empty($request->tech_stack)) {
             $validated['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
             $validated['tech_stack'] = [];
        }

        \App\Models\Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        if ($request->has('tech_stack') && !empty($request->tech_stack)) {
             $validated['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
             $validated['tech_stack'] = [];
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
