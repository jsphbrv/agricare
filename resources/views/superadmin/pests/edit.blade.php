@extends('layouts.superadmin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Edit Pest</h3>

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
    <form action="{{ route('superadmin.pests.update', $pest->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Common Name -->
        <div class="form-group mb-3">
            <label>Common Name</label>
            <input type="text" name="common_name" class="form-control" required value="{{ old('common_name', $pest->common_name) }}">
        </div>

        <!-- Scientific Name -->
        <div class="form-group mb-3">
            <label>Scientific Name</label>
            <input type="text" name="scientific_name" class="form-control" required value="{{ old('scientific_name', $pest->scientific_name) }}">
        </div>

        <!-- Crop -->
        <div class="form-group mb-3">
            <label>Crop</label>
            <select name="crop" class="form-control" required>
                <option value="rice" {{ old('crop', $pest->crop) == 'rice' ? 'selected' : '' }}>Rice</option>
                <option value="corn" {{ old('crop', $pest->crop) == 'corn' ? 'selected' : '' }}>Corn</option>
            </select>
        </div>

        <!-- Pesticide -->
        <div class="form-group mb-3">
            <label>Recommended Pesticide (optional)</label>
            <select name="pesticide_id" class="form-control">
                <option value="">-- None --</option>
                @foreach ($pesticides as $pesticide)
                    <option value="{{ $pesticide->id }}" {{ old('pesticide_id', $pest->pesticide_id) == $pesticide->id ? 'selected' : '' }}>
                        {{ $pesticide->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label>Upload New Image (optional)</label><br>
            <input type="file" name="image" accept="image/*" class="form-control-file">
            @if($pest->image)
                <small class="text-muted d-block mt-2">Current Image:</small>
                <img src="{{ asset('images/pests/' . $pest->image) }}" alt="Pest Image" style="max-width: 100px;">
            @endif
        </div>

        <div class="text-center">
            <button class="btn btn-primary" type="submit">Update Pest</button>
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
