@extends('admin.layouts.app')

@section('title', 'Create Artist')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Create Artist</h1>
        <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

    <form method="POST" action="{{ route('admin.artists.store') }}" class="card p-4">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm mb-2">Name</label>
            <input type="text" name="name" id="name" required class="form-input" value="{{ old('name') }}">
            @error('name')
                <p class="mt-1 text-sm text-red">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Create Artist</button>
        </div>
    </form>
</div>
@endsection