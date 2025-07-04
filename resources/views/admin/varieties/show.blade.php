@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 700px;">
    <h3 class="text-center mb-4">Variety Details</h3>

    <div class="card">
        <div class="card-body text-center">

            <!-- Image Display -->
            @php
                $isRice = isset($variety->type) && $variety->type === 'rice';
                $imgFolder = $isRice ? 'rice' : 'corn';
                $imgFile = $variety->image ? asset("images/{$imgFolder}/" . $variety->image) : asset("images/{$imgFolder}/default.png");
            @endphp
            <img src="{{ $imgFile }}"
                 alt="{{ $variety->name }}"
                 class="img-fluid rounded mb-3"
                 style="max-height: 250px; object-fit: cover;">

            <p><strong>Variety Name:</strong> {{ $variety->name }}</p>
            <p><strong>Crop Type:</strong> {{ ucfirst($variety->type ?? $imgFolder) }}</p>
            <p><strong>Description:</strong><br>{{ $variety->description }}</p>
            <p><strong>Added On:</strong>
                {{ $variety->created_at ? $variety->created_at->format('F d, Y h:i A') : 'N/A' }}
            </p>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.varieties.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
