@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Add New Crop Variety</h3>

    <form method="POST" action="{{ route('admin.varieties.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">-- Select Type --</option>
                <option value="rice">Rice</option>
                <option value="corn">Corn</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Variety Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image (Optional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Save Variety</button>
        <a href="{{ route('admin.varieties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
