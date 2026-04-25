<?php

namespace Tests\Feature;

use Database\Seeders\AudioCatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AudioCatalogDatabaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        $this->seed(AudioCatalogSeeder::class);
    }

    public function test_audio_catalog_is_seeded_into_database(): void
    {
        $this->assertDatabaseHas('artists', [
            'name' => 'Ado',
            'slug' => 'ado',
        ]);

        $this->assertDatabaseHas('albums', [
            'title' => 'Ado Spectrum',
            'slug' => 'ado-spectrum',
        ]);

        $this->assertDatabaseHas('tracks', [
            'title' => 'Usseewa',
            'display_number' => '1.1',
        ]);
    }

    public function test_audio_index_renders_from_seeded_database(): void
    {
        $response = $this->get('/browse/audio?genre=Idol&q=Blue');

        $response->assertOk();
        $response->assertSee('Results for "Blue"', false);
        $response->assertSee('1 releases', false);
        $response->assertSee('Blue Hour Parade', false);
    }

    public function test_audio_detail_renders_tracks_from_seeded_database(): void
    {
        config(['abuabu.test_force_available' => true]);
        $response = $this->get('/browse/audio/ado/ado-spectrum');

        $response->assertOk();
        $response->assertSee('Ado Spectrum', false);
        $response->assertSee('Usseewa', false);
        $response->assertSee('Download Album', false);
    }

    public function test_audio_database_download_returns_not_found_when_file_is_missing(): void
    {
        config(['abuabu.test_force_available' => false]);
        $response = $this->get('/browse/audio/ado/ado-spectrum/download');

        $response->assertNotFound();
    }
}
