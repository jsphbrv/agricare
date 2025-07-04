@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('admin.fertilizers.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>
    <div class="card shadow border border-2" style="border-radius: 12px;">
        <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                @if ($fertilizer->image)
                    <img src="{{ asset('images/fertilizers/' . $fertilizer->image) }}" alt="{{ $fertilizer->name }}" class="img-fluid rounded" style="max-height: 250px; object-fit: cover;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ $fertilizer->name }}</h4>
                    <p><strong>Description:</strong> {{ $fertilizer->description ?? '-' }}</p>
                    <p><strong>Crop:</strong> {{ ucfirst($fertilizer->crop) ?? '-' }}</p>
                    <p><strong>Type:</strong> {{ $fertilizer->type ?? '-' }}</p>
                    <p><strong>Nutrient Content:</strong> {{ $fertilizer->nutrient_content ?? '-' }}</p>
                    <p><strong>Manufacturer:</strong> {{ $fertilizer->manufacturer ?? '-' }}</p>
                    <p><strong>Approval Status:</strong> {{ $fertilizer->approval_status ? 'Approved' : 'Not Approved' }}</p>
                    <p><strong>Created At:</strong> {{ $fertilizer->created_at ? $fertilizer->created_at->format('Y-m-d') : '-' }}</p>
                    <p><strong>Updated At:</strong> {{ $fertilizer->updated_at ? $fertilizer->updated_at->format('Y-m-d') : '-' }}</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.fertilizers.edit', $fertilizer->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                        <a href="{{ route('admin.fertilizers.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection