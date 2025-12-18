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
        $experiences = Experience::orderBy('sort_order')->get();
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
        $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'duration' => 'required|string|max:255',
            'start_day' => 'required|integer|min:1|max:31',
            'start_month' => 'required|integer|min:1|max:12',
            'start_year' => 'required|integer|min:1990',
            'end_day' => 'nullable|integer|min:1|max:31',
            'end_month' => 'nullable|integer|min:1|max:12',
            'end_year' => 'nullable|integer|min:1990',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'github_repos' => 'nullable|array',
        ]);
        
        $validated = $request->only(['position', 'company', 'duration', 'description', 'sort_order', 'is_active', 'github_repos']);
        
        // Convert dropdown values to dates
        $validated['start_date'] = sprintf('%04d-%02d-%02d', $request->start_year, $request->start_month, $request->start_day);
        
        if ($request->end_day && $request->end_month && $request->end_year) {
            $validated['end_date'] = sprintf('%04d-%02d-%02d', $request->end_year, $request->end_month, $request->end_day);
        }
        
        // Check for overlapping experiences
        $query = Experience::where('id', '!=', 0);
        if ($validated['end_date']) {
            $query->where(function($q) use ($validated) {
                $q->where(function($subQ) use ($validated) {
                    $subQ->whereNull('end_date')
                         ->where('start_date', '<=', $validated['end_date']);
                })->orWhere(function($subQ) use ($validated) {
                    $subQ->whereNotNull('end_date')
                         ->where('start_date', '<=', $validated['end_date'])
                         ->where('end_date', '>=', $validated['start_date']);
                });
            });
        } else {
            $query->where('start_date', '<=', now());
        }
        
        if ($query->exists()) {
            return back()->withErrors(['start_date' => 'This experience overlaps with an existing experience.'])->withInput();
        }

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
        $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'duration' => 'required|string|max:255',
            'start_day' => 'required|integer|min:1|max:31',
            'start_month' => 'required|integer|min:1|max:12',
            'start_year' => 'required|integer|min:1990',
            'end_day' => 'nullable|integer|min:1|max:31',
            'end_month' => 'nullable|integer|min:1|max:12',
            'end_year' => 'nullable|integer|min:1990',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'github_repos' => 'nullable|array',
        ]);
        
        $validated = $request->only(['position', 'company', 'duration', 'description', 'sort_order', 'is_active', 'github_repos']);
        
        // Convert dropdown values to dates
        $validated['start_date'] = sprintf('%04d-%02d-%02d', $request->start_year, $request->start_month, $request->start_day);
        
        if ($request->end_day && $request->end_month && $request->end_year) {
            $validated['end_date'] = sprintf('%04d-%02d-%02d', $request->end_year, $request->end_month, $request->end_day);
        }
        
        // Check for overlapping experiences (excluding current one)
        $query = Experience::where('id', '!=', $experience->id);
        if ($validated['end_date']) {
            $query->where(function($q) use ($validated) {
                $q->where(function($subQ) use ($validated) {
                    $subQ->whereNull('end_date')
                         ->where('start_date', '<=', $validated['end_date']);
                })->orWhere(function($subQ) use ($validated) {
                    $subQ->whereNotNull('end_date')
                         ->where('start_date', '<=', $validated['end_date'])
                         ->where('end_date', '>=', $validated['start_date']);
                });
            });
        } else {
            $query->where('start_date', '<=', now());
        }
        
        if ($query->exists()) {
            return back()->withErrors(['start_date' => 'This experience overlaps with an existing experience.'])->withInput();
        }

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
