<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\ToolDownload;
use App\Models\ToolHelpArticle;
use App\Helpers\UploadHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index(): View
    {
        $query = Tool::query();
        
        if (request('search')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('category', 'like', '%' . request('search') . '%');
            });
        }
        
        if (request('type')) {
            $query->where('type', request('type'));
        }
        
        return view('admin.tools.index', [
            'tools' => $query->orderBy('title')->paginate(20)->appends(request()->query()),
        ]);
    }

    public function create(): View
    {
        return view('admin.tools.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:utility,game,recovery,module'],
            'version' => ['nullable', 'string', 'max:20'],
            'category' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'changelog' => ['nullable', 'string'],
            'specs' => ['nullable', 'array'],
            'metadata' => ['nullable', 'array'],
            'download_enabled' => ['boolean'],
            'download_disk' => ['nullable', 'string', 'max:50'],
            'download_path' => ['nullable', 'string', 'max:500'],
            'download_filename' => ['nullable', 'string', 'max:255'],
            'download_label' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $tool = Tool::create($validated);

        if ($validated['download_enabled'] ?? false) {
            ToolDownload::create([
                'tool_id' => $tool->id,
                'enabled' => true,
                'disk' => $validated['download_disk'] ?? 'local',
                'path' => $validated['download_path'],
                'filename' => $validated['download_filename'] ?? $validated['slug'].'.zip',
                'label' => $validated['download_label'] ?? 'Download',
            ]);
        }

        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function show(Tool $tool): View
    {
        return view('admin.tools.show', [
            'tool' => $tool->load(['download', 'helpArticles']),
        ]);
    }

    public function edit(Tool $tool): View
    {
        return view('admin.tools.edit', [
            'tool' => $tool->load(['download', 'helpArticles']),
        ]);
    }

    public function update(Request $request, Tool $tool): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:utility,game,recovery,module'],
            'version' => ['nullable', 'string', 'max:20'],
            'category' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'changelog' => ['nullable', 'string'],
            'specs' => ['nullable', 'array'],
            'metadata' => ['nullable', 'array'],
            'download_enabled' => ['boolean'],
            'download_disk' => ['nullable', 'string', 'max:50'],
            'download_path' => ['nullable', 'string', 'max:500'],
            'download_filename' => ['nullable', 'string', 'max:255'],
            'download_label' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $tool->update($validated);

        $tool->download()->delete();
        if ($validated['download_enabled'] ?? false) {
            ToolDownload::create([
                'tool_id' => $tool->id,
                'enabled' => true,
                'disk' => $validated['download_disk'] ?? 'local',
                'path' => $validated['download_path'],
                'filename' => $validated['download_filename'] ?? $validated['slug'].'.zip',
                'label' => $validated['download_label'] ?? 'Download',
            ]);
        }

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool): RedirectResponse
    {
        $tool->delete();

        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
    }

    public function storeHelp(Request $request, Tool $tool): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $validated['tool_id'] = $tool->id;

        ToolHelpArticle::create($validated);

        return redirect()->route('admin.tools.show', $tool)->with('success', 'Help article created.');
    }

    public function destroyHelp(Tool $tool, ToolHelpArticle $helpArticle): RedirectResponse
    {
        $helpArticle->delete();

        return redirect()->route('admin.tools.show', $tool)->with('success', 'Help article deleted.');
    }

    public function cover(Tool $tool): View
    {
        return view('admin.tools.cover', ['tool' => $tool]);
    }

    public function uploadCover(Request $request, Tool $tool): RedirectResponse
    {
        $request->validate([
            'cover_image' => ['nullable', 'string', 'max:500'],
            'cover_file' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        $slug = $tool->slug;

        if ($request->hasFile('cover_file')) {
            $coverPath = UploadHelper::handleCoverUpload($request->file('cover_file'), 'tools', $slug);
            if ($coverPath) {
                $tool->update([
                    'cover_image' => $coverPath,
                    'cover_alt' => $tool->title . ' cover',
                ]);
            }
        } elseif ($request->filled('cover_image')) {
            $oldCover = $tool->cover_image;
            $tool->update(['cover_image' => $request->cover_image]);
            if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
                UploadHelper::deleteFile($oldCover);
            }
        }

        return redirect()->route('admin.tools.show', $tool)->with('success', 'Cover updated successfully.');
    }

    public function deleteCover(Tool $tool): RedirectResponse
    {
        $oldCover = $tool->cover_image;
        if ($oldCover && !Str::startsWith($oldCover, ['http://', 'https://'])) {
            UploadHelper::deleteFile($oldCover);
        }
        $tool->update(['cover_image' => null, 'cover_alt' => null]);

        return redirect()->route('admin.tools.show', $tool)->with('success', 'Cover deleted successfully.');
    }
}