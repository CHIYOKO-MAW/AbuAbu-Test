<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('vendor')->nullable();
            $table->string('version')->nullable();
            $table->string('category')->index();
            $table->json('os')->nullable();
            $table->json('tags')->nullable();
            $table->text('summary')->nullable();
            $table->boolean('featured')->default(false)->index();
            $table->string('accent')->nullable();
            $table->string('icon')->nullable();
            $table->date('updated_at_date')->nullable();
            $table->string('filesize')->nullable();
            $table->string('checksum')->nullable();
            $table->string('download_count')->nullable();
            $table->text('release_notes')->nullable();
            $table->json('notes')->nullable();
            $table->json('dependencies')->nullable();
            
            // Game specific fields
            $table->string('release_status')->nullable();
            $table->string('license_state')->nullable();
            $table->string('build_type')->nullable();
            $table->json('archive_notes')->nullable();
            $table->json('screenshots')->nullable();
            $table->json('requirements')->nullable();
            
            $table->timestamps();
        });

        Schema::create('tool_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete();
            $table->boolean('enabled')->default(false);
            $table->string('disk')->default('local');
            $table->string('path')->nullable();
            $table->string('filename')->nullable();
            $table->string('label')->default('Download package');
            $table->string('size')->nullable();
            $table->timestamps();
        });

        Schema::create('tool_help_articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('product')->nullable();
            $table->text('summary')->nullable();
            $table->json('symptoms')->nullable();
            $table->json('steps')->nullable();
            $table->json('related_tools')->nullable(); // array of tool slugs
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tool_help_articles');
        Schema::dropIfExists('tool_downloads');
        Schema::dropIfExists('tools');
    }
};
