<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        Setting::updateOrCreate(
            ['key' => 'contact_description'],
            ['value' => 'Ready to bring your vision to life? Let\'s connect and create something amazing.']
        );
    }

    public function down(): void
    {
        Setting::where('key', 'contact_description')->delete();
    }
};