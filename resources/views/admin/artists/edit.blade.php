@extends('admin.layouts.app')

@section('title', 'Edit Artist')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Edit Artist</h1>
        <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

    <form method="POST" action="{{ route('admin.artists.update', $artist) }}" class="card p-4">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-sm mb-2">Name</label>
            <input type="text" name="name" id="name" required class="form-input" value="{{ old('name', $artist->name) }}">
            @error('name')
                <p class="mt-1 text-sm text-red">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Update Artist</button>
        </div>
    </form>
</div>
@endsection