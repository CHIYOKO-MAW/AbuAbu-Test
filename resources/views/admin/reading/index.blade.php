@extends('admin.layouts.app')

@section('title', 'Reading')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Reading</h1>
        <a href="{{ route('admin.reading.create') }}" class="btn btn-primary">Add Item</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form method="GET" class="card p-4 mb-4">
        <div class="grid grid-cols-4 gap-3">
            <div class="col-span-2">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="form-input">
            </div>
            <div>
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="ebook" {{ request('type')=='ebook'?'selected':'' }}>Ebook</option>
                    <option value="journal" {{ request('type')=='journal'?'selected':'' }}>Journal</option>
                    <option value="essay" {{ request('type')=='essay'?'selected':'' }}>Essay</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary flex-1">Search</button>
                @if(request('search')||request('type'))
                <a href="{{ route('admin.reading.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </div>
        </div>
    </form>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Author</th>
                    <th>Topic</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td class="text-muted">{{ $item->type }}</td>
                    <td class="text-muted">{{ $item->author }}</td>
                    <td class="text-muted">{{ $item->topic }}</td>
                    <td>
                        <a href="{{ route('admin.reading.show', $item) }}" class="mr-3">View</a>
                        <a href="{{ route('admin.reading.edit', $item) }}" class="mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.reading.destroy', $item) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted p-4">No items found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 pagination">{{ $items->links() }}</div>
</div>
@endsection