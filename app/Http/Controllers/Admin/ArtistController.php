<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    public function index(): View
    {
        $query = Artist::query();
        
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
        
        return view('admin.artists.index', [
            'artists' => $query->orderBy('name')->paginate(20)->appends(request()->query()),
        ]);
    }

    public function create(): View
    {
        return view('admin.artists.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Artist::create($validated);

        return redirect()->route('admin.artists.index')->with('success', 'Artist created successfully.');
    }

    public function edit(Artist $artist): View
    {
        return view('admin.artists.edit', ['artist' => $artist]);
    }

    public function update(Request $request, Artist $artist): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $artist->update($validated);

        return redirect()->route('admin.artists.index')->with('success', 'Artist updated successfully.');
    }

    public function destroy(Artist $artist): RedirectResponse
    {
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('success', 'Artist deleted successfully.');
    }
}