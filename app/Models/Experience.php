<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['position', 'company', 'duration', 'description', 'is_active', 'sort_order', 'github_repos'];

    protected $casts = [
        'github_repos' => 'array',
        'is_active' => 'boolean',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->orderBy('sort_order');
    }
}
