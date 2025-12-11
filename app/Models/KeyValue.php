<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
    protected $fillable = ['key', 'value', 'type', 'icon', 'sort_order', 'is_active'];
}
