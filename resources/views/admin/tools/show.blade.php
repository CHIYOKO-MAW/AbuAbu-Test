@extends('admin.layouts.app')

@section('title', $tool->title)

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>{{ $tool->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.tools.cover', $tool) }}" class="btn btn-secondary">Cover</a>
            <a href="{{ route('admin.tools.edit', $tool) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin.tools.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-muted">Type:</span> {{ $tool->type }}</div>
            <div><span class="text-muted">Version:</span> {{ $tool->version }}</div>
            <div><span class="text-muted">Category:</span> {{ $tool->category }}</div>
            <div><span class="text-muted">Slug:</span> {{ $tool->slug }}</div>
        </div>
    </div>

    @if($tool->summary)
    <div class="card p-4 mb-4">
        <h2 class="mb-2">Summary</h2>
        <p>{{ $tool->summary }}</p>
    </div>
    @endif

    @if($tool->description)
    <div class="card p-4 mb-4">
        <h2 class="mb-2">Description</h2>
        <p>{{ $tool->description }}</p>
    </div>
    @endif

    <div class="card p-4">
        <h2 class="mb-4">Download</h2>
        @if($tool->download)
            <div class="text-sm">
                <p><span class="text-muted">Enabled:</span> {{ $tool->download->enabled ? 'Yes' : 'No' }}</p>
                <p><span class="text-muted">Path:</span> {{ $tool->download->path }}</p>
                <p><span class="text-muted">Filename:</span> {{ $tool->download->filename }}</p>
            </div>
        @else
            <p class="text-muted">No download configured</p>
        @endif
    </div>
</div>
@endsection