<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['position', 'company', 'duration', 'start_date', 'end_date', 'description', 'is_active', 'sort_order', 'github_repos'];

    protected $casts = [
        'github_repos' => 'array',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->orderBy('sort_order');
    }
    
    public function getFormattedDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = \Carbon\Carbon::parse($this->start_date)->format('M Y');
            $end = \Carbon\Carbon::parse($this->end_date)->format('M Y');
            return $start . ' - ' . $end;
        } elseif ($this->start_date) {
            $start = \Carbon\Carbon::parse($this->start_date)->format('M Y');
            return $start . ' - Present';
        }
        return $this->duration;
    }
}
