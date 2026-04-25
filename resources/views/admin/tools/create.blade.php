@extends('admin.layouts.app')

@section('title', 'Create Tool')

@section('content')
<div class="max-w">
    <div class="flex items-center justify-between mb-6">
        <h1>Create Tool</h1>
        <a href="{{ route('admin.tools.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

    <form method="POST" action="{{ route('admin.tools.store') }}" enctype="multipart/form-data" class="card p-4">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="title" class="block text-sm mb-2">Title</label>
                <input type="text" name="title" id="title" required class="form-input" value="{{ old('title') }}">
            </div>

            <div>
                <label for="type" class="block text-sm mb-2">Type</label>
                <select name="type" id="type" required class="form-select">
                    <option value="utility" {{ old('type') == 'utility' ? 'selected' : '' }}>Utility</option>
                    <option value="game" {{ old('type') == 'game' ? 'selected' : '' }}>Game</option>
                    <option value="recovery" {{ old('type') == 'recovery' ? 'selected' : '' }}>Recovery</option>
                    <option value="module" {{ old('type') == 'module' ? 'selected' : '' }}>Module</option>
                </select>
            </div>

            <div>
                <label for="version" class="block text-sm mb-2">Version</label>
                <input type="text" name="version" id="version" placeholder="v1.0.0" class="form-input" value="{{ old('version') }}">
            </div>

            <div>
                <label for="category" class="block text-sm mb-2">Category</label>
                <input type="text" name="category" id="category" class="form-input" value="{{ old('category') }}">
            </div>
        </div>

        <div class="mb-4">
            <label for="summary" class="block text-sm mb-2">Summary</label>
            <textarea name="summary" id="summary" rows="2" class="form-input">{{ old('summary') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="form-input">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="changelog" class="block text-sm mb-2">Changelog</label>
            <textarea name="changelog" id="changelog" rows="4" class="form-input">{{ old('changelog') }}</textarea>
        </div>

        <div class="border-t border-border pt-4 mb-4">
            <div class="flex items-center mb-4">
                <input type="checkbox" name="download_enabled" id="download_enabled" value="1" {{ old('download_enabled') ? 'checked' : '' }}>
                <label for="download_enabled" class="ml-2">Enable Download</label>
            </div>
            <div class="grid grid-cols-2 gap-4" id="download_fields" style="{{ old('download_enabled') ? '' : 'display:none' }}">
                <div>
                    <label for="download_disk" class="block text-sm mb-2">Disk</label>
                    <select name="download_disk" id="download_disk" class="form-select">
                        <option value="local">Local</option>
                    </select>
                </div>
                <div>
                    <label for="download_filename" class="block text-sm mb-2">Filename</label>
                    <input type="text" name="download_filename" id="download_filename" class="form-input" value="{{ old('download_filename') }}">
                </div>
                <div class="col-span-2">
                    <label for="download_path" class="block text-sm mb-2">Path</label>
                    <input type="text" name="download_path" id="download_path" class="form-input" value="{{ old('download_path') }}">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

<script>
document.getElementById('download_enabled').addEventListener('change', function() {
    document.getElementById('download_fields').style.display = this.checked ? 'grid' : 'none';
});
</script>
@endsection