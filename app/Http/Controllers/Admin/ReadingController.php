<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReadingItem;
use App\Models\ReadingDownload;
use App\Helpers\UploadHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ReadingController extends Controller
{
    public function index(): View
    {
        $query = ReadingItem::query();
        
        if (request('search')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('author', 'like', '%' . request('search') . '%')
                  ->orWhere('topic', 'like', '%' . request('search') . '%');
            });
        }
        
        if (request('type')) {
            $query->where('type', request('type'));
        }
        
        return view('admin.reading.index', [
            'items' => $query->orderBy('published_at', 'desc')->paginate(20)->appends(request()->query()),
        ]);
    }

    public function create(): View
    {
        return view('admin.reading.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:journal,ebook,essay,notes'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:8'],
            'topic' => ['nullable', 'string', 'max:100'],
            'published_at' => ['nullable', 'date'],
            'summary' => ['nullable', 'string'],
            'abstract' => ['nullable', 'string'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'pages' => ['nullable', 'string', 'max:20'],
            'format' => ['nullable', 'string', 'max:50'],
            'cover_image' => ['nullable', 'string', 'max:500'],
            'download_enabled' => ['boolean'],
            'download_disk' => ['nullable', 'string', 'max:50'],
            'download_path' => ['nullable', 'string', 'max:500'],
            'download_filename' => ['nullable', 'string', 'max:255'],
            'download_label' => ['nullable', 'string', 'max:100'],
            'cover_file' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        $slug = Str::slug($validated['title']);
        $validated['slug'] = $slug;
        $validated['topic'] = $validated['topic'] ?? 'General';

        if ($request->hasFile('cover_file')) {
            $coverPath = UploadHelper::handleCoverUpload($request->file('cover_file'), 'reading', $slug);
            if ($coverPath) {
                $validated['cover_image'] = $coverPath;
            }
        }

        $item = ReadingItem::create($validated);

        if ($validated['download_enabled'] ?? false) {
            ReadingDownload::create([
                'reading_item_id' => $item->id,
                'enabled' => true,
                'disk' => $validated['download_disk'] ?? 'local',
                'path' => $validated['download_path'],
                'filename' => $validated['download_filename'] ?? $slug.'.pdf',
                'label' => $validated['download_label'] ?? 'Download file',
            ]);
        }

        return redirect()->route('admin.reading.index')->with('success', 'Reading item created successfully.');
    }

    public function show(ReadingItem $reading): View
    {
        return view('admin.reading.show', [
            'item' => $reading->load('download'),
        ]);
    }

    public function edit(ReadingItem $reading): View
    {
        return view('admin.reading.edit', [
            'item' => $reading->load('download'),
        ]);
    }

    public function update(Request $request, ReadingItem $reading): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:journal,ebook,essay,notes'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:8'],
            'topic' => ['nullable', 'string', 'max:100'],
            'published_at' => ['nullable', 'date'],
            'summary' => ['nullable', 'string'],
            'abstract' => ['nullable', 'string'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'pages' => ['nullable', 'string', 'max:20'],
            'format' => ['nullable', 'string', 'max:50'],
            'cover_image' => ['nullable', 'string', 'max:500'],
            'download_enabled' => ['boolean'],
            'download_disk' => ['nullable', 'string', 'max:50'],
            'download_path' => ['nullable', 'string', 'max:500'],
            'download_filename' => ['nullable', 'string', 'max:255'],
            'download_label' => ['nullable', 'string', 'max:100'],
            'cover_file' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        $slug = Str::slug($validated['title']);
        $validated['slug'] = $slug;
        $validated['topic'] = $validated['topic'] ?? 'General';

        if ($request->hasFile('cover_file')) {
            $oldCover = $reading->cover_image;
            $coverPath = UploadHelper::handleCoverUpload($request->file('cover_file'), 'reading', $slug);
            if ($coverPath) {
                $validated['cover_image'] = $coverPath;
                if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
                    UploadHelper::deleteFile($oldCover);
                }
            }
        }

        $reading->update($validated);

        $reading->download()->delete();
        if ($validated['download_enabled'] ?? false) {
            ReadingDownload::create([
                'reading_item_id' => $reading->id,
                'enabled' => true,
                'disk' => $validated['download_disk'] ?? 'local',
                'path' => $validated['download_path'],
                'filename' => $validated['download_filename'] ?? $slug.'.pdf',
                'label' => $validated['download_label'] ?? 'Download file',
            ]);
        }

        return redirect()->route('admin.reading.index')->with('success', 'Reading item updated successfully.');
    }

    public function destroy(ReadingItem $reading): RedirectResponse
    {
        $reading->delete();

        return redirect()->route('admin.reading.index')->with('success', 'Reading item deleted successfully.');
    }

    public function cover(ReadingItem $reading): View
    {
        return view('admin.reading.cover', ['item' => $reading]);
    }

    public function uploadCover(Request $request, ReadingItem $reading): RedirectResponse
    {
        $request->validate([
            'cover_image' => ['nullable', 'string', 'max:500'],
            'cover_file' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        $slug = $reading->slug;

        if ($request->hasFile('cover_file')) {
            $coverPath = UploadHelper::handleCoverUpload($request->file('cover_file'), 'reading', $slug);
            if ($coverPath) {
                $reading->update(['cover_image' => $coverPath]);
            }
        } elseif ($request->filled('cover_image')) {
            $oldCover = $reading->cover_image;
            $reading->update(['cover_image' => $request->cover_image]);
            if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
                UploadHelper::deleteFile($oldCover);
            }
        }

        return redirect()->route('admin.reading.show', $reading)->with('success', 'Cover updated successfully.');
    }

    public function deleteCover(ReadingItem $reading): RedirectResponse
    {
        $oldCover = $reading->cover_image;
        if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
            UploadHelper::deleteFile($oldCover);
        }
        $reading->update(['cover_image' => null]);

        return redirect()->route('admin.reading.show', $reading)->with('success', 'Cover deleted successfully.');
    }
}