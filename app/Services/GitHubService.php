<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\GitHubRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GitHubService
{
    /**
     * Fetch and sync repositories from GitHub API to database.
     */
    public function syncRepositories($username)
    {
        $token = env('GITHUB_TOKEN');

        if (!$username) {
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
                ...($token ? ['Authorization' => 'Bearer ' . $token] : [])
            ])->get("https://api.github.com/users/{$username}/repos", [
                'sort' => 'updated',
                'direction' => 'desc',
                'per_page' => 100,
                'type' => 'owner'
            ]);

            if ($response->successful()) {
                $repos = collect($response->json());
                
                foreach ($repos as $repo) {
                    // Fetch language data for each repo
                    $languages = $this->getRepositoryLanguages($username, $repo['name'], $token);
                    
                    GitHubRepository::updateOrCreate(
                        [
                            'github_username' => $username,
                            'name' => $repo['name']
                        ],
                        [
                            'description' => $repo['description'],
                            'html_url' => $repo['html_url'],
                            'stargazers_count' => $repo['stargazers_count'],
                            'language' => $repo['language'],
                            'languages' => $languages,
                            'updated_at_github' => $repo['updated_at'],
                        ]
                    );
                }
                
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        
        return false;
    }

    /**
     * Get language percentages for a repository.
     */
    private function getRepositoryLanguages($username, $repoName, $token)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
                ...($token ? ['Authorization' => 'Bearer ' . $token] : [])
            ])->get("https://api.github.com/repos/{$username}/{$repoName}/languages");

            if ($response->successful()) {
                $languages = $response->json();
                $total = array_sum($languages);
                
                if ($total > 0) {
                    $percentages = [];
                    foreach ($languages as $lang => $bytes) {
                        $percentages[$lang] = round(($bytes / $total) * 100, 1);
                    }
                    return $percentages;
                }
            }
        } catch (\Exception $e) {
            // Ignore language fetch errors
        }
        
        return [];
    }

    /**
     * Get repositories from database.
     */
    public function getRepositories()
    {
        $username = Setting::where('key', 'github_username')->value('value');
        
        if (!$username) {
            return [];
        }

        return GitHubRepository::where('github_username', $username)
            ->orderBy('updated_at_github', 'desc')
            ->get()
            ->map(function ($repo) {
                return [
                    'id' => $repo->id,
                    'name' => $repo->name,
                    'description' => $repo->description,
                    'html_url' => $repo->html_url,
                    'stargazers_count' => $repo->stargazers_count,
                    'language' => $repo->language,
                    'languages' => $repo->languages,
                    'image' => $repo->image,
                    'live_url' => $repo->live_url,
                    'updated_at' => $repo->updated_at_github,
                ];
            })
            ->toArray();
    }
}
