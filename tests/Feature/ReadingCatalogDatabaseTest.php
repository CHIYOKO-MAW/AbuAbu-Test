<?php

namespace Tests\Feature;

use Database\Seeders\ReadingCatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReadingCatalogDatabaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        $this->seed(ReadingCatalogSeeder::class);
    }

    public function test_reading_catalog_is_seeded_into_database(): void
    {
        $this->assertDatabaseHas('reading_items', [
            'title' => 'Quiet Systems Vol. 12',
            'slug' => 'quiet-systems-vol-12',
            'type' => 'journal',
        ]);

        $this->assertDatabaseHas('reading_items', [
            'title' => 'Field Guide to Interface Writing',
            'slug' => 'field-guide-to-interface-writing',
            'type' => 'ebook',
        ]);
    }

    public function test_reading_index_renders_from_seeded_database(): void
    {
        $response = $this->get('/browse/reading?type=journal&topic=Research+Methods&q=Ledger');

        $response->assertOk();
        $response->assertSee('Results for "Ledger"', false);
        $response->assertSee('1 items', false);
        $response->assertSee('Open Review Ledger 03', false);
    }

    public function test_reading_detail_renders_from_seeded_database(): void
    {
        config(['abuabu.test_force_available' => true]);
        $response = $this->get('/browse/reading/journal/quiet-systems-vol-12');

        $response->assertOk();
        $response->assertSee('Document preview', false);
        $response->assertSee('Quiet Systems Vol. 12', false);
        $response->assertSee('Download PDF', false);
    }

    public function test_reading_database_download_returns_not_found_when_file_is_missing(): void
    {
        config(['abuabu.test_force_available' => false]);
        $response = $this->get('/browse/reading/journal/quiet-systems-vol-12/download');

        $response->assertNotFound();
    }
}
