<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\GitHubRepository;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        if (!$experience->is_active) {
            abort(404);
        }
        
        // Eager load projects that are active and sorted
        $projects = $experience->projects()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Get only the GitHub repositories selected for this experience
        $githubRepos = collect();
        if (is_array($experience->github_repos) && count($experience->github_repos) > 0) {
            $repoNames = collect($experience->github_repos)->pluck('name');
            $githubRepos = GitHubRepository::whereIn('name', $repoNames)
                ->orderBy('stargazers_count', 'desc')
                ->get();
        }

        return view('experience.show', compact('experience', 'projects', 'githubRepos'));
    }
}
