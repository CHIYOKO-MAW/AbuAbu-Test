<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\AlbumFormat;
use App\Models\AlbumDownload;
use App\Models\Track;
use App\Helpers\UploadHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index(): View
    {
        $query = Album::with('artist');
        
        if (request('search')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhereHas('artist', function($aq) {
                      $aq->where('name', 'like', '%' . request('search') . '%');
                  });
            });
        }
        
        if (request('type')) {
            $query->where('type', request('type'));
        }
        
        return view('admin.albums.index', [
            'albums' => $query->orderBy('title')->paginate(20)->appends(request()->query()),
        ]);
    }

    public function create(): View
    {
        return view('admin.albums.create', [
            'artists' => Artist::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'artist_id' => ['required', 'exists:artists,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:album,ep,single'],
            'genre' => ['nullable', 'string', 'max:100'],
            'release_date' => ['nullable', 'date'],
            'label' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:50'],
            'featured' => ['boolean'],
            'recommended' => ['boolean'],
            'cover_image' => ['nullable', 'string', 'max:500'],
            'cover_alt' => ['nullable', 'string', 'max:500'],
            'cover_palette' => ['nullable', 'array'],
            'spec_audio' => ['nullable', 'string'],
            'spec_note' => ['nullable', 'string'],
            'bit_depth' => ['nullable', 'string', 'max:20'],
            'sample_rate' => ['nullable', 'string', 'max:20'],
            'editor_notes' => ['nullable', 'string'],
            'formats' => ['nullable', 'array'],
            'download_enabled' => ['boolean'],
            'download_disk' => ['nullable', 'string', 'max:50'],
            'download_path' => ['nullable', 'string', 'max:500'],
            'download_filename' => ['nullable', 'string', 'max:255'],
            'download_label' => ['nullable', 'string', 'max:100'],
            'cover_file' => ['nullable', 'file', 'image', 'max:30720'],
        ]);

        $slug = Str::slug($validated['title']);
        
        if ($request->hasFile('cover_file')) {
            $coverPath = UploadHelper::handleCoverUpload($request->file('cover_file'), 'albums', $slug);
            if ($coverPath) {
                $validated['cover_image'] = $coverPath;
                if (empty($validated['cover_alt'])) {
                    $validated['cover_alt'] = $validated['title'] . ' cover';
                }
            }
        }

        $validated['slug'] = $slug;

        $album = Album::create($validated);

        if (!empty($validated['formats'])) {
            foreach ($validated['formats'] as $format) {
                AlbumFormat::create(['album_id' => $album->id, 'format' => $format]);
            }
        }

        if ($validated['download_enabled'] ?? false) {
            AlbumDownload::create([
                'album_id' => $album->id,
                'enabled' => true,
                'disk' => $validated['download_disk'] ?? 'local',
                'path' => $validated['download_path'],
                'filename' => $validated['download_filename'] ?? $validated['slug'].'.zip',
                'label' => $validated['download_label'] ?? 'Download Album',
            ]);
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album created successfully.');
    }

    public function show(Album $album): View
    {
        return view('admin.albums.show', [
            'album' => $album->load(['artist', 'albumFormats', 'tracks', 'download']),
        ]);
    }

    public function edit(Album $album): View
    {
        return view('admin.albums.edit', [
            'album' => $album->load(['artist', 'albumFormats', 'tracks', 'download']),
            'artists' => Artist::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Album $album): RedirectResponse
    {
        $validated = $request->validate([
            'artist_id' => ['required', 'exists:artists,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:album,ep,single'],
            'genre' => ['nullable', 'string', 'max:100'],
            'release_date' => ['nullable', 'date'],
            'label' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:50'],
            'featured' => ['boolean'],
            'recommended' => ['boolean'],
            'cover_image' => ['nullable', 'string', 'max:500'],
            'cover_alt' => ['nullable', 'string', 'max:500'],
            'cover_palette' => ['nullable', 'array'],
            'spec_audio' => ['nullable', 'string'],
            'spec_note' => ['nullable', 'string'],
            'bit_depth' => ['nullable', 'string', 'max:20'],
            'sample_rate' => ['nullable', 'string', 'max:20'],
            'editor_notes' => ['nullable', 'string'],
            'formats' => ['nullable', 'array'],
            'download_enabled' => ['boolean'],
            'download_disk' => ['nullable', 'string', 'max:50'],
            'download_path' => ['nullable', 'string', 'max:500'],
            'download_filename' => ['nullable', 'string', 'max:255'],
            'download_label' => ['nullable', 'string', 'max:100'],
            'cover_file' => ['nullable', 'file', 'image', 'max:30720'],
        ]);

        $slug = Str::slug($validated['title']);
        
        if ($request->hasFile('cover_file')) {
            $oldCover = $album->cover_image;
            $coverPath = UploadHelper::handleCoverUpload($request->file('cover_file'), 'albums', $slug);
            if ($coverPath) {
                $validated['cover_image'] = $coverPath;
                if (empty($validated['cover_alt'])) {
                    $validated['cover_alt'] = $validated['title'] . ' cover';
                }
                if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
                    UploadHelper::deleteFile($oldCover);
                }
            }
        }

        $validated['slug'] = $slug;

        $album->update($validated);

        $album->albumFormats()->delete();
        if (!empty($validated['formats'])) {
            foreach ($validated['formats'] as $format) {
                AlbumFormat::create(['album_id' => $album->id, 'format' => $format]);
            }
        }

        $album->download()->delete();
        if ($validated['download_enabled'] ?? false) {
            AlbumDownload::create([
                'album_id' => $album->id,
                'enabled' => true,
                'disk' => $validated['download_disk'] ?? 'local',
                'path' => $validated['download_path'],
                'filename' => $validated['download_filename'] ?? $validated['slug'].'.zip',
                'label' => $validated['download_label'] ?? 'Download Album',
            ]);
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album): RedirectResponse
    {
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.');
    }

    public function tracks(Request $request, Album $album): RedirectResponse
    {
        $validated = $request->validate([
            'tracks' => ['required', 'array'],
            'tracks.*.title' => ['required', 'string'],
            'tracks.*.duration' => ['nullable', 'string'],
            'tracks.*.artist_name' => ['nullable', 'string'],
            'tracks.*.preview_url' => ['nullable', 'string', 'max:500'],
        ]);

        $album->tracks()->delete();
        foreach ($validated['tracks'] as $index => $trackData) {
            $trackData['album_id'] = $album->id;
            $trackData['disc_number'] = 1;
            $trackData['track_number'] = $index + 1;
            $trackData['display_number'] = '1.'.($index + 1);
            $trackData['sort_order'] = $index + 1;
            $trackData['preview_url'] = $trackData['preview_url'] ?? null;
            Track::create($trackData);
        }

        return redirect()->route('admin.albums.show', $album)->with('success', 'Tracks updated successfully.');
    }

    public function cover(Album $album): View
    {
        return view('admin.albums.cover', ['album' => $album]);
    }

    public function uploadCover(Request $request, Album $album): RedirectResponse
    {
        $validationRules = [
            'cover_image' => ['nullable', 'string', 'max:500'],
            'cover_file' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp,svg,gif', 'max:30720'],
        ];

        $validated = $request->validate($validationRules);
        $slug = $album->slug;

        if ($request->hasFile('cover_file')) {
            $file = $request->file('cover_file');
            $coverPath = UploadHelper::handleCoverUpload($file, 'albums', $slug);
            
            if ($coverPath) {
                $oldCover = $album->cover_image;
                $album->update([
                    'cover_image' => $coverPath,
                    'cover_alt' => $album->title . ' cover',
                ]);
                
                if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
                    UploadHelper::deleteFile($oldCover);
                }
                
                return redirect()->route('admin.albums.show', $album)->with('success', 'Cover uploaded successfully.');
            } else {
                $extension = $file->getClientOriginalExtension();
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif'];
                $size = $file->getSize();
                $maxSize = 30 * 1024 * 1024;
                
                if (!in_array(strtolower($extension), $allowed)) {
                    return redirect()->back()->with('error', 'Invalid file type. Allowed: jpg, jpeg, png, webp, svg, gif.');
                }
                if ($size > $maxSize) {
                    return redirect()->back()->with('error', 'File too large. Maximum 30MB.');
                }
                return redirect()->back()->with('error', 'Upload failed. Please try again.');
            }
        } elseif ($request->filled('cover_image')) {
            $oldCover = $album->cover_image;
            $album->update(['cover_image' => $request->cover_image]);
            if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
                UploadHelper::deleteFile($oldCover);
            }
            return redirect()->route('admin.albums.show', $album)->with('success', 'Cover URL updated successfully.');
        }

        return redirect()->back()->with('error', 'No cover image provided.');
    }

    public function deleteCover(Album $album): RedirectResponse
    {
        $oldCover = $album->cover_image;
        if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
            UploadHelper::deleteFile($oldCover);
        }
        $album->update(['cover_image' => null, 'cover_alt' => null]);

        return redirect()->route('admin.albums.show', $album)->with('success', 'Cover deleted successfully.');
    }
}