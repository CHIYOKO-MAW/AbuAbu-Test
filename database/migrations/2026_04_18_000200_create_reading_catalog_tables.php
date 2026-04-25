<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_items', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index();       // journal, ebook, essay, notes
            $table->string('slug');
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('year', 8)->nullable();
            $table->string('topic')->nullable()->index();
            $table->date('published_at')->nullable()->index();
            $table->date('updated_at_date')->nullable()->index();
            $table->text('summary')->nullable();
            $table->text('abstract')->nullable();
            $table->string('publisher')->nullable();
            $table->string('pages')->nullable();
            $table->string('format')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('cover_alt')->nullable();
            $table->json('cover_palette')->nullable();
            $table->timestamps();

            $table->unique(['type', 'slug']);
        });

        Schema::create('reading_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reading_item_id')->constrained()->cascadeOnDelete();
            $table->boolean('enabled')->default(false);
            $table->string('disk')->default('local');
            $table->string('path')->nullable();
            $table->string('filename')->nullable();
            $table->string('label')->default('Download file');
            $table->string('size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_downloads');
        Schema::dropIfExists('reading_items');
    }
};
