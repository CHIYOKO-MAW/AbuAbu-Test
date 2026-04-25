@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Reading Item')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Edit Reading Item</h1>
        <a href="{{ route('admin.reading.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

    <form method="POST" action="{{ route('admin.reading.update', $item) }}" enctype="multipart/form-data" class="card p-4">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="type" class="block text-sm mb-2">Type</label>
                <select name="type" id="type" required class="form-select">
                    <option value="ebook" {{ $item->type == 'ebook' ? 'selected' : '' }}>Ebook</option>
                    <option value="journal" {{ $item->type == 'journal' ? 'selected' : '' }}>Journal</option>
                    <option value="essay" {{ $item->type == 'essay' ? 'selected' : '' }}>Essay</option>
                    <option value="notes" {{ $item->type == 'notes' ? 'selected' : '' }}>Notes</option>
                </select>
            </div>

            <div>
                <label for="title" class="block text-sm mb-2">Title</label>
                <input type="text" name="title" id="title" required class="form-input" value="{{ old('title', $item->title) }}">
            </div>

            <div>
                <label for="author" class="block text-sm mb-2">Author</label>
                <input type="text" name="author" id="author" class="form-input" value="{{ old('author', $item->author) }}">
            </div>

            <div>
                <label for="year" class="block text-sm mb-2">Year</label>
                <input type="text" name="year" id="year" class="form-input" value="{{ old('year', $item->year) }}">
            </div>

            <div>
                <label for="topic" class="block text-sm mb-2">Topic</label>
                <input type="text" name="topic" id="topic" class="form-input" value="{{ old('topic', $item->topic) }}">
            </div>

            <div>
                <label for="published_at" class="block text-sm mb-2">Published Date</label>
                <input type="date" name="published_at" id="published_at" class="form-input" value="{{ old('published_at', $item->published_at?->toDateString()) }}">
            </div>

            <div>
                <label for="publisher" class="block text-sm mb-2">Publisher</label>
                <input type="text" name="publisher" id="publisher" class="form-input" value="{{ old('publisher', $item->publisher) }}">
            </div>

            <div>
                <label for="pages" class="block text-sm mb-2">Pages</label>
                <input type="text" name="pages" id="pages" class="form-input" value="{{ old('pages', $item->pages) }}">
            </div>
        </div>

        <div class="mb-4">
            <label for="summary" class="block text-sm mb-2">Summary</label>
            <textarea name="summary" id="summary" rows="2" class="form-input">{{ old('summary', $item->summary) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="abstract" class="block text-sm mb-2">Abstract</label>
            <textarea name="abstract" id="abstract" rows="4" class="form-input">{{ old('abstract', $item->abstract) }}</textarea>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <h3 class="mb-4">Cover</h3>
            
            @php
                $hasExistingFile = !empty($item->cover_image) && !Str::startsWith($item->cover_image, ['http://', 'https://']);
                $isUrl = Str::startsWith($item->cover_image, ['http://', 'https://']);
            @endphp

            <div class="flex gap-4 mb-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="cover_type" value="url" {{ $isUrl || !$hasExistingFile ? 'checked' : '' }} onchange="toggleCoverInput()">
                    <span class="ml-2 text-sm">URL</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="cover_type" value="file" {{ $hasExistingFile && !$isUrl ? 'checked' : '' }} onchange="toggleCoverInput()">
                    <span class="ml-2 text-sm">Upload File</span>
                </label>
            </div>

            <div id="cover_url_section" class="{{ $isUrl || !$hasExistingFile ? '' : 'hidden' }}">
                <div>
                    <label for="cover_image" class="block text-sm mb-2">Image URL</label>
                    <input type="text" name="cover_image" id="cover_image" placeholder="https://example.com/cover.jpg" class="form-input" value="{{ old('cover_image', $item->cover_image) }}">
                </div>
            </div>

            <div id="cover_file_section" class="{{ $hasExistingFile && !$isUrl ? '' : 'hidden' }}">
                <div>
                    <label for="cover_file" class="block text-sm mb-2">Upload Cover Image</label>
                    <input type="file" name="cover_file" id="cover_file" accept="image/*" class="form-input">
                    <p class="mt-1 text-xs text-muted">Max 30MB: jpg, png, webp, svg, gif</p>
                    @if($hasExistingFile)
                    <p class="mt-2 text-xs text-green">Current: {{ $item->cover_image }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <div class="flex items-center mb-4">
                <input type="checkbox" name="download_enabled" id="download_enabled" value="1" {{ $item->download?->enabled ? 'checked' : '' }}>
                <label for="download_enabled" class="ml-2">Enable Download</label>
            </div>
            <div class="grid grid-cols-2 gap-4" id="download_fields" style="{{ $item->download?->enabled ? '' : 'display:none' }}">
                <div>
                    <label for="download_disk" class="block text-sm mb-2">Disk</label>
                    <select name="download_disk" id="download_disk" class="form-select">
                        <option value="local" {{ ($item->download?->disk ?? 'local') == 'local' ? 'selected' : '' }}>Local</option>
                    </select>
                </div>
                <div>
                    <label for="download_filename" class="block text-sm mb-2">Filename</label>
                    <input type="text" name="download_filename" id="download_filename" class="form-input" value="{{ old('download_filename', $item->download?->filename) }}">
                </div>
                <div class="col-span-2">
                    <label for="download_path" class="block text-sm mb-2">Path</label>
                    <input type="text" name="download_path" id="download_path" class="form-input" value="{{ old('download_path', $item->download?->path) }}">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<script>
document.getElementById('download_enabled').addEventListener('change', function() {
    document.getElementById('download_fields').style.display = this.checked ? 'grid' : 'none';
});

function toggleCoverInput() {
    const coverType = document.querySelector('input[name="cover_type"]:checked').value;
    document.getElementById('cover_url_section').className = coverType === 'url' ? '' : 'hidden';
    document.getElementById('cover_file_section').className = coverType === 'file' ? '' : 'hidden';
}

document.addEventListener('DOMContentLoaded', function() {
    toggleCoverInput();
    if(document.getElementById('download_enabled').checked) {
        document.getElementById('download_fields').style.display = 'grid';
    }
});
</script>
@endsection