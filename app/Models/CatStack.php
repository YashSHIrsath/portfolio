<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatStack extends Model
{
    protected $fillable = ['key', 'values', 'sort_order', 'is_active'];

    protected $casts = [
        'values' => 'array',
        'is_active' => 'boolean',
    ];
}
