<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\GitHubRepository;
use App\Services\GitHubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GitHubSettingController extends Controller
{
    public function edit(GitHubService $gitHubService)
    {
        $username = Setting::where('key', 'github_username')->value('value');
        $hasToken = !empty(env('GITHUB_TOKEN'));
        
        // Get repositories for this username
        $repositories = [];
        if ($username) {
            $repositories = GitHubRepository::where('github_username', $username)
                ->orderBy('updated_at_github', 'desc')
                ->get();
        }

        return view('admin.settings.github', compact('username', 'hasToken', 'repositories'));
    }

    public function update(Request $request, GitHubService $gitHubService)
    {
        $request->validate([
            'github_username' => 'required|string|max:255',
        ]);

        $oldUsername = Setting::where('key', 'github_username')->value('value');
        $newUsername = $request->github_username;

        Setting::updateOrCreate(
            ['key' => 'github_username'],
            ['value' => $newUsername]
        );

        // If username changed, sync repositories
        if ($oldUsername !== $newUsername) {
            $gitHubService->syncRepositories($newUsername);
        }

        return redirect()->route('admin.github-settings.edit')
            ->with('success', 'GitHub settings updated and repositories synced successfully.');
    }

    public function updateRepository(Request $request, $id)
    {
        $request->validate([
            'live_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $repository = GitHubRepository::findOrFail($id);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($repository->image) {
                Storage::disk('public')->delete($repository->image);
            }
            
            $imagePath = $request->file('image')->store('github-repos', 'public');
            $repository->image = $imagePath;
        }
        
        $repository->live_url = $request->live_url;
        $repository->save();

        return redirect()->route('admin.github-projects.index')
            ->with('success', 'Repository updated successfully.');
    }

    public function syncRepositories(GitHubService $gitHubService)
    {
        $username = Setting::where('key', 'github_username')->value('value');
        
        if ($username && $gitHubService->syncRepositories($username)) {
            return redirect()->route('admin.github-settings.edit')
                ->with('success', 'Repositories synced successfully.');
        }
        
        return redirect()->route('admin.github-settings.edit')
            ->with('error', 'Failed to sync repositories.');
    }

    public function githubProjects()
    {
        $username = Setting::where('key', 'github_username')->value('value');
        
        $repositories = collect();
        if ($username) {
            $repositories = GitHubRepository::where('github_username', $username)
                ->orderBy('updated_at_github', 'desc')
                ->get();
        }

        return view('admin.github_projects.index', compact('repositories', 'username'));
    }
}
