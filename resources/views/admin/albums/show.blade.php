@extends('admin.layouts.app')

@section('title', $album->title)

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>{{ $album->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.albums.cover', $album) }}" class="btn btn-secondary">Cover</a>
            <a href="{{ route('admin.albums.edit', $album) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-muted">Artist:</span> {{ $album->artist?->name }}</div>
            <div><span class="text-muted">Type:</span> {{ $album->type }}</div>
            <div><span class="text-muted">Genre:</span> {{ $album->genre }}</div>
            <div><span class="text-muted">Label:</span> {{ $album->label }}</div>
            <div><span class="text-muted">Release Date:</span> {{ $album->release_date }}</div>
            <div><span class="text-muted">Duration:</span> {{ $album->duration }}</div>
            <div><span class="text-muted">Featured:</span> {{ $album->featured ? 'Yes' : 'No' }}</div>
            <div><span class="text-muted">Recommended:</span> {{ $album->recommended ? 'Yes' : 'No' }}</div>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <h2 class="mb-4">Tracks</h2>
        <form method="POST" action="{{ route('admin.albums.tracks', $album) }}">
            @csrf
            <div id="track-list">
                @forelse($album->tracks as $index => $track)
                    <div class="flex gap-3 items-center mb-3">
                        <span class="text-muted w-8">{{ $index + 1 }}</span>
                        <input type="text" name="tracks[{{ $index }}][title]" value="{{ $track->title }}" placeholder="Title" required class="form-input flex-1">
                        <input type="text" name="tracks[{{ $index }}][artist_name]" value="{{ $track->artist_name }}" placeholder="Artist" class="form-input w-40">
                        <input type="text" name="tracks[{{ $index }}][duration]" value="{{ $track->duration }}" placeholder="Duration" class="form-input w-24">
                        @if($track->preview_url)
                            <a href="{{ $track->preview_url }}" target="_blank" class="btn btn-sm btn-secondary" title="Play">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </a>
                        @else
                            <span class="w-8"></span>
                        @endif
                    </div>
                    <div class="flex gap-3 items-center mb-3">
                        <span class="w-8"></span>
                        <input type="text" name="tracks[{{ $index }}][preview_url]" value="{{ $track->preview_url }}" placeholder="Preview URL (Bandcamp, SoundCloud, YouTube, or internal path)" class="form-input flex-1" style="margin-top:-8px">
                    </div>
                @empty
                    <p class="text-muted">No tracks yet.</p>
                @endforelse
            </div>
            <button type="submit" class="btn btn-primary mt-4">Save Tracks</button>
        </form>
    </div>

    <div class="card p-4">
        <h2 class="mb-4">Formats</h2>
        <div class="flex flex-wrap gap-2">
            @forelse($album->albumFormats as $format)
                <span class="badge badge-blue">{{ $format->format }}</span>
            @empty
                <span class="text-muted">No formats</span>
            @endforelse
        </div>
    </div>
</div>
@endsection