<?php

namespace Database\Seeders;

use App\Models\IntakeRequest;
use Illuminate\Database\Seeder;

class RequestIntakeSeeder extends Seeder
{
    public function run(): void
    {
        IntakeRequest::create([
            'title' => 'Calm Browsing Patterns EPUB',
            'category' => 'Reading',
            'source' => 'https://example.com/calm-browsing',
            'notes' => 'Please check if we can add the mobi version as well.',
            'priority' => 'Normal',
            'status' => 'Pending review',
        ]);

        IntakeRequest::create([
            'title' => 'Glass Harbor VR update',
            'category' => 'Tools',
            'source' => 'Developer provided patch',
            'notes' => 'Needs to be merged with base archive. Contains updated controller maps.',
            'priority' => 'Review fast',
            'status' => 'Need source check',
        ]);

        IntakeRequest::create([
            'title' => 'Archive Thinking for Small Teams',
            'category' => 'Reading',
            'source' => 'Author submitted',
            'notes' => 'Metadata is complete. Ready for publishing.',
            'priority' => 'Normal',
            'status' => 'Ready for shelf',
        ]);
    }
}
