<?php

namespace App\Http\Controllers;

use App\Models\IntakeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:ebooks,music,software,other'],
            'source_context' => ['nullable', 'string', 'max:500'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['priority'] = 'normal';
        $validated['status'] = 'pending';

        IntakeRequest::create($validated);

        return redirect()->route('request')->with('success', 'Request submitted successfully. We\'ll review it soon.');
    }
}