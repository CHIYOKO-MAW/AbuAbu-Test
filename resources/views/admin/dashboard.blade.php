@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w">
    <h1 class="mb-6">Dashboard</h1>

    <!-- Stats -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <a href="{{ route('admin.artists.index') }}" class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <div class="stat-label">Artists</div>
                <div class="stat-value">{{ $stats['artists'] }}</div>
            </div>
        </a>

        <a href="{{ route('admin.albums.index') }}" class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19V6l12-3v13"/></svg>
            </div>
            <div>
                <div class="stat-label">Albums</div>
                <div class="stat-value">{{ $stats['albums'] }}</div>
            </div>
        </a>

        <a href="{{ route('admin.reading.index') }}" class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13"/></svg>
            </div>
            <div>
                <div class="stat-label">Reading</div>
                <div class="stat-value">{{ $stats['reading'] }}</div>
            </div>
        </a>

        <a href="{{ route('admin.tools.index') }}" class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div class="stat-label">Tools</div>
                <div class="stat-value">{{ $stats['tools'] }}</div>
            </div>
        </a>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-6">
        <div class="card-header">
            <h2>Quick Actions</h2>
        </div>
        <div class="card-body grid grid-cols-4 gap-3">
            <a href="{{ route('admin.artists.create') }}" class="btn btn-secondary btn-sm">+ New Artist</a>
            <a href="{{ route('admin.albums.create') }}" class="btn btn-secondary btn-sm">+ New Album</a>
            <a href="{{ route('admin.reading.create') }}" class="btn btn-secondary btn-sm">+ New Reading</a>
            <a href="{{ route('admin.tools.create') }}" class="btn btn-secondary btn-sm">+ New Tool</a>
        </div>
    </div>

    <!-- Recent -->
    <div class="grid grid-cols-3 gap-4">
        <div class="card">
            <div class="card-header">
                <h2>Recent Albums</h2>
                <a href="{{ route('admin.albums.index') }}" class="btn-link">View all</a>
            </div>
            @forelse($recentAlbums as $album)
            <a href="{{ route('admin.albums.show', $album) }}" class="item-row">
                <div class="item-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19V6l12-3"/></svg>
                </div>
                <div>
                    <div class="item-title">{{ $album->title }}</div>
                    <div class="item-sub">{{ $album->artist?->name }}</div>
                </div>
                @if($album->featured)<span class="badge badge-green">Featured</span>@endif
            </a>
            @empty
            <div class="p-4 text-muted">No albums yet</div>
            @endforelse
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Recent Reading</h2>
                <a href="{{ route('admin.reading.index') }}" class="btn-link">View all</a>
            </div>
            @forelse($recentReading as $item)
            <a href="{{ route('admin.reading.show', $item) }}" class="item-row">
                <div class="item-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6.253v13"/></svg>
                </div>
                <div>
                    <div class="item-title">{{ $item->title }}</div>
                    <div class="item-sub">{{ $item->type }}</div>
                </div>
            </a>
            @empty
            <div class="p-4 text-muted">No items yet</div>
            @endforelse
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Recent Tools</h2>
                <a href="{{ route('admin.tools.index') }}" class="btn-link">View all</a>
            </div>
            @forelse($recentTools as $tool)
            <a href="{{ route('admin.tools.show', $tool) }}" class="item-row">
                <div class="item-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0"/></svg>
                </div>
                <div>
                    <div class="item-title">{{ $tool->title }}</div>
                    <div class="item-sub">{{ $tool->version }}</div>
                </div>
            </a>
            @empty
            <div class="p-4 text-muted">No tools yet</div>
            @endforelse
        </div>
    </div>
</div>
@endsection