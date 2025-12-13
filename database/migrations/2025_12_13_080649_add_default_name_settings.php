<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add default name settings if they don't exist
        \App\Models\Setting::firstOrCreate(
            ['key' => 'first_name'],
            ['value' => 'John']
        );
        
        \App\Models\Setting::firstOrCreate(
            ['key' => 'last_name'],
            ['value' => 'Doe']
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\Setting::whereIn('key', ['first_name', 'last_name'])->delete();
    }
};
