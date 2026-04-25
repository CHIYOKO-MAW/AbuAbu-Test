@extends('admin.layouts.app')

@section('title', 'Albums')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Albums</h1>
        <a href="{{ route('admin.albums.create') }}" class="btn btn-primary">Add Album</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <!-- Search -->
    <form method="GET" class="card p-4 mb-4">
        <div class="grid grid-cols-4 gap-3">
            <div class="col-span-2">
                <input type="text" name="search" placeholder="Search albums..." value="{{ request('search') }}" class="form-input">
            </div>
            <div>
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="album" {{ request('type')=='album'?'selected':'' }}>Album</option>
                    <option value="ep" {{ request('type')=='ep'?'selected':'' }}>EP</option>
                    <option value="single" {{ request('type')=='single'?'selected':'' }}>Single</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary flex-1">Search</button>
                @if(request('search')||request('type'))
                <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Type</th>
                    <th>Genre</th>
                    <th>Featured</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                <tr>
                    <td><strong>{{ $album->title }}</strong></td>
                    <td class="text-muted">{{ $album->artist?->name }}</td>
                    <td class="text-muted">{{ $album->type }}</td>
                    <td class="text-muted">{{ $album->genre }}</td>
                    <td>@if($album->featured)<span class="badge badge-green">Yes</span>@else<span class="text-muted">-</span>@endif</td>
                    <td>
                        <a href="{{ route('admin.albums.show', $album) }}" class="mr-3">View</a>
                        <a href="{{ route('admin.albums.edit', $album) }}" class="mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.albums.destroy', $album) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted p-4">No albums found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 pagination">{{ $albums->links() }}</div>
</div>
@endsection