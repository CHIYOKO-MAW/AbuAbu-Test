<?php

namespace Tests\Feature;

use Database\Seeders\RequestIntakeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestIntakeDatabaseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RequestIntakeSeeder::class);
    }

    public function test_intake_requests_are_seeded_into_database(): void
    {
        $this->assertDatabaseHas('intake_requests', [
            'title' => 'Calm Browsing Patterns EPUB',
            'category' => 'Reading',
        ]);
    }

    public function test_request_form_renders_correctly(): void
    {
        $response = $this->get('/request');

        $response->assertOk();
        $response->assertSee('Structured intake form', false);
        $response->assertSee('Title', false);
        $response->assertSee('Category', false);
    }
}
