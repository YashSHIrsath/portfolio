<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypingText extends Model
{
    protected $fillable = ['text', 'active', 'sort_order'];
    
    protected $casts = [
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
