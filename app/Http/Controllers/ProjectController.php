<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\GitHubRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Fetch local projects
        $projects = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch GitHub repos from database
        $githubRepos = GitHubRepository::orderBy('stargazers_count', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('projects', compact('projects', 'githubRepos'));
    }
}
