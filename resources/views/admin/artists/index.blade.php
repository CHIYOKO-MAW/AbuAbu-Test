@extends('admin.layouts.app')

@section('title', 'Artists')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Artists</h1>
        <a href="{{ route('admin.artists.create') }}" class="btn btn-primary">Add Artist</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="GET" class="card p-4 mb-4">
        <div class="grid grid-cols-4 gap-3">
            <div class="col-span-2">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="form-input">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary flex-1">Search</button>
                @if(request('search'))
                <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </div>
            <div></div>
        </div>
    </form>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Albums</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($artists as $artist)
                <tr>
                    <td><strong>{{ $artist->name }}</strong></td>
                    <td class="text-muted">{{ $artist->slug }}</td>
                    <td class="text-muted">{{ $artist->albums->count() }}</td>
                    <td>
                        <a href="{{ route('admin.artists.edit', $artist) }}" class="mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.artists.destroy', $artist) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted p-4">No artists found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 pagination">{{ $artists->links() }}</div>
</div>
@endsection