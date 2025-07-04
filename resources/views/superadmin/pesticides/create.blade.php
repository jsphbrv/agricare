@extends('layouts.superadmin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Add Pesticide</h3>

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

    {{-- ✅ Form --}}
    <form action="{{ route('superadmin.pesticides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Pesticide Name -->
        <div class="form-group mb-3">
            <label>Pesticide Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
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

        <!-- Used For -->
        <div class="form-group mb-3">
            <label>Used For</label>
            <input type="text" name="used_for" class="form-control" required value="{{ old('used_for') }}">
        </div>

        <!-- Active Ingredient -->
        <div class="form-group mb-3">
            <label>Active Ingredient</label>
            <input type="text" name="active_ingredient" class="form-control" required value="{{ old('active_ingredient') }}">
        </div>

        <!-- Description -->
        <div class="form-group mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label>Upload Image</label>
            <input type="file" name="image" accept="image/*" class="form-control-file" required>
        </div>

        <div class="text-center">
            <button class="btn btn-success" type="submit">Add Pesticide</button>
        </div>
    </form>
</div>

{{-- ✅ Auto-hide alert --}}
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
