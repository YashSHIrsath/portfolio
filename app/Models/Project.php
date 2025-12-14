<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'work_done',
        'bullet_type',
        'link',
        'tech_stack',
        'sort_order',
        'is_active',
        'image_path',
        'images',
        'duration',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'images' => 'array',
        'work_done' => 'array',
        'is_active' => 'boolean',
    ];

    public function experiences()
    {
        return $this->belongsToMany(Experience::class);
    }
}
