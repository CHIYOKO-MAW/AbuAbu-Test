@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Cover - ' . $album->title)

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Cover: {{ $album->title }}</h1>
        <a href="{{ route('admin.albums.show', $album) }}" class="btn btn-secondary">Back</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    @php
        $currentCover = $album->cover_image;
        $hasExistingFile = !empty($currentCover) && !Str::startsWith($currentCover, ['http://', 'https://']);
        $isUrl = Str::startsWith($currentCover, ['http://', 'https://']);
    @endphp

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.albums.uploadCover', $album) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-sm mb-2">Current Cover</label>
                <div class="w-48 h-48 bg-surface-hover rounded-lg overflow-hidden flex items-center justify-center">
                    @if($currentCover)
                        @if($isUrl)
                            <img src="{{ $currentCover }}" alt="{{ $album->cover_alt }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . $currentCover) }}" alt="{{ $album->cover_alt }}" class="w-full h-full object-cover">
                        @endif
                    @else
                        <span class="text-muted text-sm">No cover</span>
                    @endif
                </div>
            </div>

            <div class="border-t border-border pt-4 mb-4">
                <label class="block text-sm mb-2">New Cover</label>
                
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
                    <input type="text" name="cover_image" id="cover_image" placeholder="https://example.com/cover.jpg"
                        class="form-input" value="{{ $currentCover }}">
                </div>

                <div id="cover_file_section" class="{{ $hasExistingFile && !$isUrl ? '' : 'hidden' }}">
                    <input type="file" name="cover_file" id="cover_file" accept="image/*" class="form-input">
                    <p class="mt-1 text-xs text-muted">Max 30MB: jpg, png, webp, svg, gif</p>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.albums.show', $album) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Cover</button>
            </div>
        </form>

        @if($currentCover)
        <form method="POST" action="{{ route('admin.albums.deleteCover', $album) }}" class="mt-4 pt-4 border-t border-border">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red text-sm" onclick="return confirm('Delete this cover?')">
                Delete Cover
            </button>
        </form>
        @endif
    </div>
</div>

<script>
function toggleCoverInput() {
    const coverType = document.querySelector('input[name="cover_type"]:checked').value;
    document.getElementById('cover_url_section').className = coverType === 'url' ? '' : 'hidden';
    document.getElementById('cover_file_section').className = coverType === 'file' ? '' : 'hidden';
}
</script>
@endsection