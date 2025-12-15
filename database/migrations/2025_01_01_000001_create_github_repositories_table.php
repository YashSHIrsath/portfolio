<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('github_repositories', function (Blueprint $table) {
            $table->id();
            $table->string('github_username');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('html_url');
            $table->integer('stargazers_count')->default(0);
            $table->string('language')->nullable();
            $table->json('languages')->nullable(); // Language percentages
            $table->string('image')->nullable(); // Custom image path
            $table->string('live_url')->nullable(); // Live project URL
            $table->timestamp('updated_at_github'); // GitHub's updated_at
            $table->timestamps();
            
            $table->unique(['github_username', 'name']);
            $table->index('github_username');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('github_repositories');
    }
};