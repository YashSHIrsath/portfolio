<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\GitHubService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(GitHubService $gitHubService)
    {
        // Fetch local projects
        $projects = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch GitHub repos
        $githubRepos = $gitHubService->getRepositories();

        return view('projects', compact('projects', 'githubRepos'));
    }
}
