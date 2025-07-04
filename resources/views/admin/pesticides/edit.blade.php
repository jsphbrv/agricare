@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Edit Pesticide</h3>

    {{-- ✅ Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Edit Form --}}
    <form action="{{ route('admin.pesticides.update', $pesticide->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="form-group mb-3">
            <label>Pesticide Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $pesticide->name) }}" required>
        </div>

        <!-- Crop -->
        <div class="form-group mb-3">
            <label>Crop</label>
            <select name="crop" class="form-control" required>
                <option value="rice" {{ old('crop', $pesticide->crop) == 'rice' ? 'selected' : '' }}>Rice</option>
                <option value="corn" {{ old('crop', $pesticide->crop) == 'corn' ? 'selected' : '' }}>Corn</option>
            </select>
        </div>

        <!-- Used For -->
        <div class="form-group mb-3">
            <label>Used For</label>
            <input type="text" name="used_for" class="form-control" value="{{ old('used_for', $pesticide->used_for) }}" required>
        </div>

        <!-- Active Ingredient -->
        <div class="form-group mb-3">
            <label>Active Ingredient</label>
            <input type="text" name="active_ingredient" class="form-control" value="{{ old('active_ingredient', $pesticide->active_ingredient) }}" required>
        </div>

        <!-- Description -->
        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $pesticide->description) }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label>Upload New Image (optional)</label>
            <input type="file" name="image" accept="image/*" class="form-control-file">
            @if ($pesticide->image)
                <p class="mt-2">Current Image:</p>
                <img src="{{ asset('uploads/pesticides/' . $pesticide->image) }}" alt="Current Image" style="max-width: 120px;">
            @endif
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Update Pesticide</button>
        </div>
    </form>
</div>
@endsection
