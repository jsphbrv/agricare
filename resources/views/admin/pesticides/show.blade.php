@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow border border-2" style="border-radius: 12px;">
        <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                @if ($pesticide->image)
                    <img src="{{ asset('uploads/pesticides/' . $pesticide->image) }}" alt="{{ $pesticide->name }}" class="img-fluid rounded" style="max-height: 250px; object-fit: cover;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ $pesticide->name }}</h4>
                    <p><strong>Crop:</strong> {{ ucfirst($pesticide->crop) }}</p>
                    <p><strong>Used For:</strong> {{ $pesticide->used_for ?? '-' }}</p>
                    <p><strong>Active Ingredient:</strong> {{ $pesticide->active_ingredient ?? '-' }}</p>
                    <p><strong>Description:</strong> {{ $pesticide->description ?? '-' }}</p>
                    <p><strong>Manufacturer:</strong> {{ $pesticide->manufacturer ?? '-' }}</p>
                    {{-- <p><strong>Approval Status:</strong> {{ $pesticide->approval_status ? 'Approved' : 'Not Approved' }}</p> --}}
                    <p><strong>Created At:</strong>
                        {{ $pesticide->created_at ? $pesticide->created_at->format('Y-m-d') : '-' }}
                    </p>
                    <p><strong>Updated At:</strong>
                        {{ $pesticide->updated_at ? $pesticide->updated_at->format('Y-m-d') : '-' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection