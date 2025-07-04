@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Crop Variety</h3>

    <form method="POST" action="{{ route('admin.varieties.update', $variety->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="rice" {{ $variety->type == 'rice' ? 'selected' : '' }}>Rice</option>
                <option value="corn" {{ $variety->type == 'corn' ? 'selected' : '' }}>Corn</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Variety Name</label>
            <input type="text" name="name" class="form-control" value="{{ $variety->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $variety->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($variety->image)
                <img src="{{ asset('images/' . $variety->type . '/' . $variety->image) }}" alt="Current Image" style="width: 150px; height: auto;">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Change Image (Optional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Variety</button>
        <a href="{{ route('admin.varieties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
