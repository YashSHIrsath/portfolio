<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GitHubRepository extends Model
{
    protected $table = 'github_repositories';
    
    protected $fillable = [
        'github_username',
        'name',
        'description',
        'html_url',
        'stargazers_count',
        'language',
        'languages',
        'image',
        'live_url',
        'updated_at_github',
    ];

    protected $casts = [
        'languages' => 'array',
        'updated_at_github' => 'datetime',
    ];
}