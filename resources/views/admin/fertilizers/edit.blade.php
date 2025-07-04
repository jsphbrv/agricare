@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Edit Fertilizer</h3>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
    <form action="{{ route('admin.fertilizers.update', $fertilizer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Fertilizer Name -->
        <div class="form-group mb-3">
            <label>Fertilizer Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $fertilizer->name) }}">
        </div>

        <!-- Description -->
        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description', $fertilizer->description) }}</textarea>
        </div>

        <!-- Crop -->
        <div class="form-group mb-3">
            <label>Crop</label>
            <input type="text" name="crop" class="form-control" required value="{{ old('crop', $fertilizer->crop) }}">
        </div>

        <!-- Type -->
        <div class="form-group mb-3">
            <label>Type</label>
            <input type="text" name="type" class="form-control" required value="{{ old('type', $fertilizer->type) }}">
        </div>

        <!-- Nutrient Content -->
        <div class="form-group mb-3">
            <label>Nutrient Content</label>
            <input type="text" name="nutrient_content" class="form-control" required value="{{ old('nutrient_content', $fertilizer->nutrient_content) }}">
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label>Upload New Image (optional)</label><br>
            <input type="file" name="image" accept="image/*" class="form-control-file">
            @if($fertilizer->image)
                <small class="text-muted d-block mt-2">Current Image:</small>
                <img src="{{ asset('images/fertilizers/' . $fertilizer->image) }}" alt="Fertilizer Image" style="max-width: 100px;">
            @endif
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Update Fertilizer</button>
            <a href="{{ route('admin.fertilizers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

{{-- ✅ Auto-hide Alert --}}
<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            alert.style.opacity = 0;
        }
    }, 4000);
</script>
@endsection
