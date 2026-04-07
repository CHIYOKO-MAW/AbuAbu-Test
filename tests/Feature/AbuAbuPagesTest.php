<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AbuAbuPagesTest extends TestCase
{
    public function test_homepage_renders_the_brand_shell_in_default_language(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Abu-Abu', false);
        $response->assertSee('Beberapa file ditemukan. Sisanya menunggu dibuka pelan-pelan.', false);
        $response->assertSee('Empat jalur masuk', false);
        $response->assertSee('Masuk ke arsip', false);
    }

    public function test_homepage_can_switch_to_english_copy(): void
    {
        $response = $this->get('/?lang=en');

        $response->assertOk();
        $response->assertSee('Some files are already in sight. The rest wait to be opened slowly.', false);
        $response->assertSee('Four access paths', false);
        $response->assertSee('Enter archive', false);
    }

    public function test_audio_page_renders_filter_controls(): void
    {
        $response = $this->get('/browse/audio');

        $response->assertOk();
        $response->assertSee('Curated digital music archive', false);
        $response->assertSee('Search artist, album, or release', false);
        $response->assertSee('Recommended albums to start with', false);
        $response->assertSee('Ado Spectrum', false);
        $response->assertSee('Blue Hour Parade', false);
        $response->assertSee('images/audio/ado-spectrum.svg', false);
    }

    public function test_audio_filters_can_reduce_the_results(): void
    {
        $response = $this->get('/browse/audio?genre=Idol&q=Blue');

        $response->assertOk();
        $response->assertSee('Results for "Blue"', false);
        $response->assertSee('1 releases', false);
        $response->assertSee('Blue Hour Parade', false);
    }

    public function test_audio_album_detail_page_renders_album_specs_and_tracks(): void
    {
        $response = $this->get('/browse/audio/ado/ado-spectrum');

        $response->assertOk();
        $response->assertSee('Ado Spectrum', false);
        $response->assertSee('Available in 48 kHz / 24-bit FLAC and lossless download formats', false);
        $response->assertSee('Usseewa', false);
        $response->assertSee('Technical Notes', false);
        $response->assertSee('Related albums', false);
        $response->assertSee('Download Album', false);
        $response->assertSee('/browse/audio/ado/ado-spectrum/download', false);
    }

    public function test_audio_album_download_route_returns_the_archive_when_available(): void
    {
        $response = $this->get('/browse/audio/ado/ado-spectrum/download');

        $response->assertOk();
        $response->assertDownload('ado-spectrum.zip');
    }

    public function test_audio_album_download_route_returns_not_found_when_archive_is_missing(): void
    {
        Storage::fake('local');

        $detail = $this->get('/browse/audio/ado/ado-spectrum');
        $download = $this->get('/browse/audio/ado/ado-spectrum/download');

        $detail->assertOk();
        $detail->assertSee('Not available yet', false);
        $download->assertNotFound();
    }

    public function test_reading_page_renders_the_bright_editorial_library_shell(): void
    {
        $reading = $this->get('/browse/reading');
        $reading->assertOk();
        $reading->assertSee('ABU-ABU READING', false);
        $reading->assertSee('Open full library', false);
        $reading->assertSee('Quiet Systems Vol. 12', false);
        $reading->assertSee('field-guide-to-interface-writing', false);
    }

    public function test_reading_filters_can_reduce_the_results(): void
    {
        $response = $this->get('/browse/reading?type=journal&topic=Research+Methods&q=Ledger');

        $response->assertOk();
        $response->assertSee('Results for "Ledger"', false);
        $response->assertSee('1 items', false);
        $response->assertSee('Open Review Ledger 03', false);
    }

    public function test_reading_detail_page_renders_preview_and_download_cta(): void
    {
        $response = $this->get('/browse/reading/journal/quiet-systems-vol-12');

        $response->assertOk();
        $response->assertSee('Document preview', false);
        $response->assertSee('Quiet Systems Vol. 12', false);
        $response->assertSee('Download PDF', false);
        $response->assertSee('/browse/reading/journal/quiet-systems-vol-12/download', false);
        $response->assertSee('Related items', false);
    }

    public function test_reading_download_route_returns_the_document_when_available(): void
    {
        $response = $this->get('/browse/reading/journal/quiet-systems-vol-12/download');

        $response->assertOk();
        $response->assertDownload('quiet-systems-vol-12.pdf');
    }

    public function test_reading_download_route_returns_not_found_when_document_is_missing(): void
    {
        Storage::fake('local');

        $detail = $this->get('/browse/reading/journal/quiet-systems-vol-12');
        $download = $this->get('/browse/reading/journal/quiet-systems-vol-12/download');

        $detail->assertOk();
        $detail->assertSee('Not available yet', false);
        $download->assertNotFound();
    }

    public function test_tools_page_renders_the_workshop_console_shell(): void
    {
        $tools = $this->get('/browse/tools');

        $tools->assertOk();
        $tools->assertSee('ABU-ABU TOOLS', false);
        $tools->assertSee('Dense package index', false);
        $tools->assertSee('Help desk rail', false);
        $tools->assertSee('Activation Assistant', false);
        $tools->assertSee('Games archive', false);
        $tools->assertSee('Glass Harbor VR', false);
    }

    public function test_tools_filters_can_reduce_the_results(): void
    {
        $tools = $this->get('/browse/tools?category=system&os=drivers&q=Driver');

        $tools->assertOk();
        $tools->assertSee('1 packages', false);
        $tools->assertSee('Driver Pack Helper', false);
    }

    public function test_tools_detail_page_renders_download_cta_and_metadata(): void
    {
        $tools = $this->get('/browse/tools/activation-assistant');

        $tools->assertOk();
        $tools->assertSee('Activation Assistant', false);
        $tools->assertSee('Download utility', false);
        $tools->assertSee('Operational notes', false);
        $tools->assertSee('Runtime checklist', false);
    }

    public function test_tools_help_page_renders_recovery_steps_and_related_tools(): void
    {
        $help = $this->get('/browse/tools/help/windows-activation-troubleshooting');

        $help->assertOk();
        $help->assertSee('Windows activation troubleshooting', false);
        $help->assertSee('Recovery steps', false);
        $help->assertSee('Recommended tools', false);
        $help->assertSee('Activation Assistant', false);
    }

    public function test_tools_game_detail_page_renders_release_style_sections(): void
    {
        $game = $this->get('/browse/tools/glass-harbor-vr');

        $game->assertOk();
        $game->assertSee('Glass Harbor VR', false);
        $game->assertSee('Release status', false);
        $game->assertSee('License state', false);
        $game->assertSee('System requirements', false);
        $game->assertSee('Screenshots', false);
        $game->assertSee('Download game archive', false);
    }

    public function test_tools_download_route_returns_the_archive_when_available(): void
    {
        $download = $this->get('/browse/tools/activation-assistant/download');

        $download->assertOk();
        $download->assertDownload('activation-assistant.zip');
    }

    public function test_tools_download_route_returns_not_found_when_archive_is_missing(): void
    {
        Storage::fake('local');

        $detail = $this->get('/browse/tools/activation-assistant');
        $download = $this->get('/browse/tools/activation-assistant/download');

        $detail->assertOk();
        $detail->assertSee('Archive not available yet', false);
        $download->assertNotFound();
    }

    public function test_request_page_renders_the_intake_shell(): void
    {
        $response = $this->get('/request');

        $response->assertOk();
        $response->assertSee('Control room', false);
        $response->assertSee('Queue status', false);
        $response->assertSee('Submission shell', false);
        $response->assertSee('Structured intake form', false);
        $response->assertSee('Queue rules', false);
    }
}
