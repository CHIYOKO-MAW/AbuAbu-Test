<?php

namespace Tests\Feature;

use Database\Seeders\ToolsCatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ToolsCatalogDatabaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        $this->seed(ToolsCatalogSeeder::class);
    }

    public function test_tools_catalog_is_seeded_into_database(): void
    {
        $this->assertDatabaseHas('tools', [
            'title' => 'Activation Assistant',
            'slug' => 'activation-assistant',
            'category' => 'utilities',
        ]);

        $this->assertDatabaseHas('tool_help_articles', [
            'title' => 'Windows activation troubleshooting',
            'slug' => 'windows-activation-troubleshooting',
        ]);
    }

    public function test_tools_index_renders_from_seeded_database(): void
    {
        $response = $this->get('/browse/tools?category=installers&os=office');

        $response->assertOk();
        $response->assertSee('Bundle Installer Hub', false);
        $response->assertSee('Office License Reset', false);
    }

    public function test_tools_detail_renders_from_seeded_database(): void
    {
        config(['abuabu.test_force_available' => true]);
        $response = $this->get('/browse/tools/bundle-installer-hub');

        $response->assertOk();
        $response->assertSee('Bundle Installer Hub', false);
        $response->assertSee('Download installer hub', false);
    }

    public function test_tools_help_article_renders_from_seeded_database(): void
    {
        $response = $this->get('/browse/tools/help/office-sign-in-reset');

        $response->assertOk();
        $response->assertSee('Office sign-in reset', false);
        $response->assertSee('Fixes loops between expired sign-in sessions', false);
        $response->assertSee('Office Cleanup Tool', false); // Related tool
    }

    public function test_tools_database_download_returns_not_found_when_file_is_missing(): void
    {
        config(['abuabu.test_force_available' => false]);
        $response = $this->get('/browse/tools/activation-assistant/download');

        $response->assertNotFound();
    }
}
