@extends('admin.layouts.app')

@section('title', 'Tools')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Tools</h1>
        <a href="{{ route('admin.tools.create') }}" class="btn btn-primary">Add Tool</a>
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
                    <option value="utility" {{ request('type')=='utility'?'selected':'' }}>Utility</option>
                    <option value="game" {{ request('type')=='game'?'selected':'' }}>Game</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary flex-1">Search</button>
                @if(request('search')||request('type'))
                <a href="{{ route('admin.tools.index') }}" class="btn btn-secondary">Clear</a>
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
                    <th>Version</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($tools as $tool)
                <tr>
                    <td><strong>{{ $tool->title }}</strong></td>
                    <td class="text-muted">{{ $tool->type }}</td>
                    <td class="text-muted">{{ $tool->version }}</td>
                    <td class="text-muted">{{ $tool->category }}</td>
                    <td>
                        <a href="{{ route('admin.tools.show', $tool) }}" class="mr-3">View</a>
                        <a href="{{ route('admin.tools.edit', $tool) }}" class="mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.tools.destroy', $tool) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted p-4">No tools found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 pagination">{{ $tools->links() }}</div>
</div>
@endsection