@extends('admin.layouts.app')

@section('title', $request->title)

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>{{ $request->title }}</h1>
        <a href="{{ route('admin.requests.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card p-4 mb-4">
        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
            <div><span class="text-muted">Category:</span> {{ $request->category }}</div>
            <div><span class="text-muted">Priority:</span> {{ $request->priority }}</div>
            <div class="col-span-2"><span class="text-muted">Source Context:</span> {{ $request->source_context }}</div>
            <div><span class="text-muted">Created:</span> {{ $request->created_at }}</div>
            <div><span class="text-muted">Updated:</span> {{ $request->updated_at }}</div>
        </div>
        <div class="border-t border-border pt-4">
            <h3 class="text-sm mb-2">Notes</h3>
            <p>{{ $request->notes }}</p>
        </div>
    </div>

    <div class="card p-4">
        <h2 class="mb-4">Update Status</h2>
        <form method="POST" action="{{ route('admin.requests.update', $request) }}">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm mb-2">Status</label>
                    <select name="status" id="status" required class="form-select">
                        <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewing" {{ $request->status == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                        <option value="ready" {{ $request->status == 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="archived" {{ $request->status == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div>
                    <label for="admin_notes" class="block text-sm mb-2">Admin Notes</label>
                    <textarea name="admin_notes" id="admin_notes" rows="3" class="form-input">{{ $request->admin_notes }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection