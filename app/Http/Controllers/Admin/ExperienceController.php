<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(\App\Services\GitHubService $gitHubService)
    {
        $githubRepos = $gitHubService->getRepositories();
        return view('admin.experiences.create', compact('githubRepos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'github_repos' => 'nullable|array',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');
        
        // Decode JSON strings from checkboxes into actual arrays
        if (!empty($validated['github_repos'])) {
            $validated['github_repos'] = array_map(function ($repo) {
                return json_decode($repo, true);
            }, $validated['github_repos']);
        }

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience, \App\Services\GitHubService $gitHubService)
    {
        $githubRepos = $gitHubService->getRepositories();
        return view('admin.experiences.edit', compact('experience', 'githubRepos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'github_repos' => 'nullable|array',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['is_active'] = $request->has('is_active');

        // Decode JSON strings from checkboxes into actual arrays
        if (!empty($validated['github_repos'])) {
            $validated['github_repos'] = array_map(function ($repo) {
                return json_decode($repo, true);
            }, $validated['github_repos']);
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully.');
    }
}
