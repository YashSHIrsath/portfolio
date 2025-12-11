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
        Schema::create('key_values', function (Blueprint $table) {
            $table->id();
            $table->string('key'); // e.g., "Years Experience"
            $table->string('value'); // e.g., "5+"
            $table->string('type')->default('stat'); // To categorize if needed
            $table->string('icon')->nullable(); // Optional icon class
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('key_values');
    }
};
