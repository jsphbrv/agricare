@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Add Fertilizer</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.fertilizers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Fertilizer Name -->
        <div class="form-group mb-3">
            <label>Fertilizer Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <!-- Description -->
        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <!-- Crop -->
        <div class="form-group mb-3">
            <label>Crop</label>
            <select name="crop" class="form-control" required>
                <option value="" disabled {{ old('crop') ? '' : 'selected' }}>Select Crop</option>
                <option value="rice" {{ old('crop') == 'rice' ? 'selected' : '' }}>Rice</option>
                <option value="corn" {{ old('crop') == 'corn' ? 'selected' : '' }}>Corn</option>
                <!-- Add more crops if needed -->
            </select>
        </div>

        <!-- Type -->
        <div class="form-group mb-3">
            <label>Type</label>
            <input type="text" name="type" class="form-control" required value="{{ old('type') }}">
        </div>

        <!-- Nutrient Content -->
        <div class="form-group mb-3">
            <label>Nutrient Content</label>
            <input type="text" name="nutrient_content" class="form-control" required value="{{ old('nutrient_content') }}">
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label>Upload Image</label>
            <input type="file" name="image" accept="images/*" class="form-control-file" required>
        </div>

        <div class="text-center">
            <button class="btn btn-success" type="submit">Add Fertilizer</button>
        </div>
    </form>
</div>

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
