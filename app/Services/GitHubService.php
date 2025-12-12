<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GitHubService
{
    /**
     * Fetch public repositories for the configured user.
     *
     * @return array
     */
    public function getRepositories()
    {
        $username = Setting::where('key', 'github_username')->value('value');
        $token = env('GITHUB_TOKEN');

        if (!$username) {
            return [];
        }

        // Cache key based on username
        $cacheKey = "github_repos_{$username}";

        return Cache::remember($cacheKey, 3600, function () use ($username, $token) {
            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/vnd.github+json',
                    'X-GitHub-Api-Version' => '2022-11-28',
                    // Only add auth if token exists (allows public access if rate limit permits, though token is preferred)
                    ...($token ? ['Authorization' => 'Bearer ' . $token] : [])
                ])->get("https://api.github.com/users/{$username}/repos", [
                    'sort' => 'updated',
                    'direction' => 'desc',
                    'per_page' => 100, // Limit to max allowed per page
                    'type' => 'owner' // Only repos owned by user
                ]);

                if ($response->successful()) {
                    return collect($response->json())->map(function ($repo) {
                        return [
                            'name' => $repo['name'],
                            'description' => $repo['description'],
                            'html_url' => $repo['html_url'],
                            'stargazers_count' => $repo['stargazers_count'],
                            'language' => $repo['language'],
                            'updated_at' => $repo['updated_at'],
                        ];
                    })->all();
                }

                return [];
            } catch (\Exception $e) {
                // Log error if needed, for now just return empty to not break the page
                return [];
            }
        });
    }
}
