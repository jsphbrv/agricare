@extends('layouts.superadmin')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Add Pest</h3>

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

    {{-- ✅ Pest Form --}}
    <form action="{{ route('superadmin.pests.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Common Name -->
        <div class="form-group mb-3">
            <label>Common Name</label>
            <input type="text" name="common_name" class="form-control" required value="{{ old('common_name') }}">
        </div>

        <!-- Scientific Name -->
        <div class="form-group mb-3">
            <label>Scientific Name</label>
            <input type="text" name="scientific_name" class="form-control" required value="{{ old('scientific_name') }}">
        </div>

        <!-- Crop -->
        <div class="form-group mb-3">
            <label>Crop</label>
            <select name="crop" class="form-control" required>
                <option value="" disabled {{ old('crop') ? '' : 'selected' }}>Select Crop</option>
                <option value="rice" {{ old('crop') == 'rice' ? 'selected' : '' }}>Rice</option>
                <option value="corn" {{ old('crop') == 'corn' ? 'selected' : '' }}>Corn</option>
            </select>
        </div>

        <!-- Pesticide (optional) -->
        <div class="form-group mb-3">
            <label>Recommended Pesticide (optional)</label>
            <select name="pesticide_id" class="form-control">
                <option value="" selected>-- None --</option>
                @foreach ($pesticides as $pesticide)
                    <option value="{{ $pesticide->id }}" {{ old('pesticide_id') == $pesticide->id ? 'selected' : '' }}>
                        {{ $pesticide->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label>Upload Image</label>
            <input type="file" name="image" accept="image/*" class="form-control-file" required>
        </div>

        <div class="text-center">
            <button class="btn btn-success" type="submit">Add Pest</button>
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
