@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Album')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Edit Album</h1>
        <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

    <form method="POST" action="{{ route('admin.albums.update', $album) }}" enctype="multipart/form-data" class="card p-4">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="artist_id" class="block text-sm mb-2">Artist</label>
                <select name="artist_id" id="artist_id" required class="form-select">
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="block text-sm mb-2">Title</label>
                <input type="text" name="title" id="title" required class="form-input" value="{{ old('title', $album->title) }}">
            </div>

            <div>
                <label for="type" class="block text-sm mb-2">Type</label>
                <select name="type" id="type" required class="form-select">
                    <option value="album" {{ $album->type == 'album' ? 'selected' : '' }}>Album</option>
                    <option value="ep" {{ $album->type == 'ep' ? 'selected' : '' }}>EP</option>
                    <option value="single" {{ $album->type == 'single' ? 'selected' : '' }}>Single</option>
                </select>
            </div>

            <div>
                <label for="genre" class="block text-sm mb-2">Genre</label>
                <input type="text" name="genre" id="genre" class="form-input" value="{{ old('genre', $album->genre) }}">
            </div>

            <div>
                <label for="release_date" class="block text-sm mb-2">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-input" value="{{ old('release_date', $album->release_date?->toDateString()) }}">
            </div>

            <div>
                <label for="label" class="block text-sm mb-2">Label</label>
                <input type="text" name="label" id="label" class="form-input" value="{{ old('label', $album->label) }}">
            </div>

            <div>
                <label for="duration" class="block text-sm mb-2">Duration</label>
                <input type="text" name="duration" id="duration" placeholder="e.g. 42m 18s" class="form-input" value="{{ old('duration', $album->duration) }}">
            </div>
        </div>

        <div class="flex items-center gap-6 mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="featured" id="featured" value="1" {{ $album->featured ? 'checked' : '' }}>
                <span class="ml-2">Featured</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="recommended" id="recommended" value="1" {{ $album->recommended ? 'checked' : '' }}>
                <span class="ml-2">Recommended</span>
            </label>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <h3 class="mb-4">Cover</h3>
            
            @php
                $hasExistingFile = !empty($album->cover_image) && !Str::startsWith($album->cover_image, ['http://', 'https://']);
                $isUrl = Str::startsWith($album->cover_image, ['http://', 'https://']);
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
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cover_image" class="block text-sm mb-2">Image URL</label>
                        <input type="text" name="cover_image" id="cover_image" placeholder="https://example.com/cover.jpg" class="form-input" value="{{ old('cover_image', $album->cover_image) }}">
                    </div>
                    <div>
                        <label for="cover_alt" class="block text-sm mb-2">Alt Text</label>
                        <input type="text" name="cover_alt" id="cover_alt" class="form-input" value="{{ old('cover_alt', $album->cover_alt) }}">
                    </div>
                </div>
            </div>

            <div id="cover_file_section" class="{{ $hasExistingFile && !$isUrl ? '' : 'hidden' }}">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cover_file" class="block text-sm mb-2">Upload Cover Image</label>
                        <input type="file" name="cover_file" id="cover_file" accept="image/*" class="form-input">
                        <p class="mt-1 text-xs text-muted">Max 30MB: jpg, png, webp, svg, gif</p>
                        @if($hasExistingFile)
                        <p class="mt-2 text-xs text-green">Current: {{ $album->cover_image }}</p>
                        @endif
                    </div>
                    <div>
                        <label for="cover_alt_file" class="block text-sm mb-2">Alt Text</label>
                        <input type="text" name="cover_alt" id="cover_alt_file" class="form-input" value="{{ old('cover_alt', $album->cover_alt) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <h3 class="mb-4">Technical Specs</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="bit_depth" class="block text-sm mb-2">Bit Depth</label>
                    <input type="text" name="bit_depth" id="bit_depth" placeholder="24-bit" class="form-input" value="{{ old('bit_depth', $album->bit_depth) }}">
                </div>
                <div>
                    <label for="sample_rate" class="block text-sm mb-2">Sample Rate</label>
                    <input type="text" name="sample_rate" id="sample_rate" placeholder="48 kHz" class="form-input" value="{{ old('sample_rate', $album->sample_rate) }}">
                </div>
                <div class="col-span-2">
                    <label for="spec_audio" class="block text-sm mb-2">Audio Description</label>
                    <textarea name="spec_audio" id="spec_audio" rows="2" class="form-input">{{ old('spec_audio', $album->spec_audio) }}</textarea>
                </div>
                <div class="col-span-2">
                    <label for="spec_note" class="block text-sm mb-2">Technical Note</label>
                    <textarea name="spec_note" id="spec_note" rows="2" class="form-input">{{ old('spec_note', $album->spec_note) }}</textarea>
                </div>
            </div>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <h3 class="mb-4">Formats</h3>
            <div class="flex flex-wrap gap-4">
                @php $currentFormats = $album->albumFormats->pluck('format')->toArray(); @endphp
                @foreach(['FLAC', '24-bit', 'Lossless', 'MP3', '320kbps', 'WAV', 'ALAC'] as $format)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="formats[]" value="{{ $format }}" {{ in_array($format, $currentFormats) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm">{{ $format }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <h3 class="mb-4">Download</h3>
            <div class="flex items-center mb-4">
                <input type="checkbox" name="download_enabled" id="download_enabled" value="1" {{ $album->download?->enabled ? 'checked' : '' }}>
                <label for="download_enabled" class="ml-2">Enable Download</label>
            </div>
            <div class="grid grid-cols-2 gap-4" id="download_fields" style="{{ $album->download?->enabled ? '' : 'display:none' }}">
                <div>
                    <label for="download_disk" class="block text-sm mb-2">Disk</label>
                    <select name="download_disk" id="download_disk" class="form-select">
                        <option value="local" {{ ($album->download?->disk ?? 'local') == 'local' ? 'selected' : '' }}>Local</option>
                        <option value="s3" {{ $album->download?->disk == 's3' ? 'selected' : '' }}>S3</option>
                    </select>
                </div>
                <div>
                    <label for="download_filename" class="block text-sm mb-2">Filename</label>
                    <input type="text" name="download_filename" id="download_filename" class="form-input" value="{{ old('download_filename', $album->download?->filename) }}">
                </div>
                <div class="col-span-2">
                    <label for="download_path" class="block text-sm mb-2">Path</label>
                    <input type="text" name="download_path" id="download_path" placeholder="audio/albums/artist/album.zip" class="form-input" value="{{ old('download_path', $album->download?->path) }}">
                </div>
            </div>
        </div>

        <div class="border-t border-border pt-4">
            <label for="editor_notes" class="block text-sm mb-2">Editor Notes</label>
            <textarea name="editor_notes" id="editor_notes" rows="3" class="form-input">{{ old('editor_notes', $album->editor_notes) }}</textarea>
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn btn-primary">Update Album</button>
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