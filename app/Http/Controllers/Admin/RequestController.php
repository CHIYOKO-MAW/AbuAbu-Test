<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntakeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    public function index(): View
    {
        return view('admin.requests.index', [
            'requests' => IntakeRequest::orderBy('created_at', 'desc')->paginate(20),
        ]);
    }

    public function show(IntakeRequest $request): View
    {
        return view('admin.requests.show', [
            'request' => $request,
        ]);
    }

    public function update(Request $request, IntakeRequest $intakeRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,reviewing,ready,archived'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $intakeRequest->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
        ]);

        return redirect()->route('admin.requests.index')->with('success', 'Request updated successfully.');
    }
}