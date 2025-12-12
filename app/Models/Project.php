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
        'link',
        'tech_stack',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_active' => 'boolean',
    ];
}
