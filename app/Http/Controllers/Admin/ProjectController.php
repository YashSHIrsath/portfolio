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
        $experiences = \App\Models\Experience::orderBy('sort_order')->get(['id', 'position', 'company']);
        return view('admin.projects.create', compact('experiences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'work_done' => 'nullable|array',
            'work_done.*' => 'nullable|string|max:255',
            'bullet_type' => 'nullable|string|in:circle,square,arrow,check,star',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'duration' => 'nullable|string|max:255',
            'experience_ids' => 'nullable|array',
            'experience_ids.*' => 'exists:experiences,id',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');
        
        if ($request->has('tech_stack') && !empty($request->tech_stack)) {
             $validated['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
             $validated['tech_stack'] = [];
        }

        if ($request->has('work_done') && is_array($request->work_done)) {
            $validated['work_done'] = array_filter(array_map('trim', $request->work_done));
        } else {
            $validated['work_done'] = [];
        }

        $validated['bullet_type'] = $request->input('bullet_type', 'circle');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('projects', 'public');
            }
            $validated['images'] = $imagePaths;
        }

        $project = \App\Models\Project::create($validated);

        if ($request->has('experience_ids')) {
            $project->experiences()->sync($request->experience_ids);
        }

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
        $experiences = \App\Models\Experience::orderBy('sort_order')->get(['id', 'position', 'company']);
        return view('admin.projects.edit', compact('project', 'experiences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'work_done' => 'nullable|array',
            'work_done.*' => 'nullable|string|max:255',
            'bullet_type' => 'nullable|string|in:circle,square,arrow,check,star',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'duration' => 'nullable|string|max:255',
            'experience_ids' => 'nullable|array',
            'experience_ids.*' => 'exists:experiences,id',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        if ($request->has('tech_stack') && !empty($request->tech_stack)) {
             $validated['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));
        } else {
             $validated['tech_stack'] = [];
        }

        if ($request->has('work_done') && is_array($request->work_done)) {
            $validated['work_done'] = array_filter(array_map('trim', $request->work_done));
        } else {
            $validated['work_done'] = [];
        }

        $validated['bullet_type'] = $request->input('bullet_type', 'circle');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('projects', 'public');
            }
            $validated['images'] = $imagePaths;
        }

        $project->update($validated);
        
        if ($request->has('experience_ids')) {
            $project->experiences()->sync($request->experience_ids);
        } else {
            $project->experiences()->detach();
        }

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
