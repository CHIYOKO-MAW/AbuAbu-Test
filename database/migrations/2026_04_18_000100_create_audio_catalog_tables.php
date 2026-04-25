<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->string('type')->default('album');
            $table->string('genre')->index();
            $table->json('formats')->nullable();
            $table->date('release_date')->nullable();
            $table->date('originated')->nullable();
            $table->string('label')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('featured')->default(false)->index();
            $table->boolean('recommended')->default(false)->index();
            $table->string('cover_image')->nullable();
            $table->string('cover_alt')->nullable();
            $table->json('cover_palette')->nullable();
            $table->string('cover_accent')->nullable();
            $table->text('spec_audio')->nullable();
            $table->text('spec_note')->nullable();
            $table->string('bit_depth')->nullable();
            $table->string('sample_rate')->nullable();
            $table->text('editor_notes')->nullable();
            $table->timestamps();

            $table->unique(['artist_id', 'slug']);
            $table->index(['type', 'genre']);
        });

        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('disc_number')->default(1);
            $table->unsignedSmallInteger('track_number')->default(1);
            $table->string('display_number');
            $table->string('title');
            $table->string('artist_name')->nullable();
            $table->string('duration')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(1);
            $table->timestamps();

            $table->index(['album_id', 'sort_order']);
        });

        Schema::create('album_formats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();
            $table->string('format');
            $table->timestamps();

            $table->unique(['album_id', 'format']);
        });

        Schema::create('album_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();
            $table->boolean('enabled')->default(false);
            $table->string('disk')->default('local');
            $table->string('path')->nullable();
            $table->string('filename')->nullable();
            $table->string('label')->default('Download Album');
            $table->string('size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album_downloads');
        Schema::dropIfExists('album_formats');
        Schema::dropIfExists('tracks');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('artists');
    }
};
