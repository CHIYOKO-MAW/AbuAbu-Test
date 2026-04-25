@extends('admin.layouts.app')

@section('title', $item->title)

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>{{ $item->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.reading.cover', $item) }}" class="btn btn-secondary">Cover</a>
            <a href="{{ route('admin.reading.edit', $item) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin.reading.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card p-4 mb-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-muted">Type:</span> {{ $item->type }}</div>
            <div><span class="text-muted">Author:</span> {{ $item->author }}</div>
            <div><span class="text-muted">Year:</span> {{ $item->year }}</div>
            <div><span class="text-muted">Topic:</span> {{ $item->topic }}</div>
            <div><span class="text-muted">Publisher:</span> {{ $item->publisher }}</div>
            <div><span class="text-muted">Pages:</span> {{ $item->pages }}</div>
            <div><span class="text-muted">Published:</span> {{ $item->published_at }}</div>
        </div>
    </div>

    @if($item->summary)
    <div class="card p-4 mb-4">
        <h2 class="mb-2">Summary</h2>
        <p>{{ $item->summary }}</p>
    </div>
    @endif

    @if($item->abstract)
    <div class="card p-4 mb-4">
        <h2 class="mb-2">Abstract</h2>
        <p>{{ $item->abstract }}</p>
    </div>
    @endif

    <div class="card p-4">
        <h2 class="mb-4">Download</h2>
        @if($item->download)
            <div class="text-sm">
                <p><span class="text-muted">Enabled:</span> {{ $item->download->enabled ? 'Yes' : 'No' }}</p>
                <p><span class="text-muted">Path:</span> {{ $item->download->path }}</p>
                <p><span class="text-muted">Filename:</span> {{ $item->download->filename }}</p>
            </div>
        @else
            <p class="text-muted">No download configured</p>
        @endif
    </div>
</div>
@endsection