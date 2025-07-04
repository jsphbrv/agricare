@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Pest Management</h4>
        <a href="{{ route('admin.pests.create') }}" class="btn btn-success">+ Add Pest</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.pests.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search pests..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <h5 class="mt-4">Palay (Rice) Pests</h5>
    <div class="row">
        @forelse($ricePests as $pest)
            <div class="col-md-4 mb-4">
                <div class="card">
                   <img 
                        src="{{ isset($pest->image) && $pest->image ? asset('images/pests/' . $pest->image) : asset('images/pests/default.png') }}" 
                        class="card-img-top" 
                        style="height: 200px; object-fit: cover;" 
                        alt="{{ $pest->common_name }}"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $pest->common_name }}</h5>
                        <p class="mb-1"><strong>Scientific Name:</strong> {{ $pest->scientific_name }}</p>
                        <a href="{{ route('admin.pests.edit', $pest->id) }}" class="btn btn-sm btn-primary mt-2">Edit</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><em>No rice pests found.</em></div>
        @endforelse
    </div>

    <h5 class="mt-4">Corn Pests</h5>
    <div class="row">
        @forelse($cornPests as $pest)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img 
                        src="{{ isset($pest->image) && $pest->image ? asset('images/pests/' . $pest->image) : asset('images/pests/default.png') }}" 
                        class="card-img-top" 
                        style="height: 200px; object-fit: cover;"
                        alt="{{ $pest->common_name }}"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $pest->common_name }}</h5>
                        <p class="mb-1"><strong>Scientific Name:</strong> {{ $pest->scientific_name }}</p>
                        <a href="{{ route('admin.pests.edit', $pest->id) }}" class="btn btn-sm btn-primary mt-2">Edit</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><em>No corn pests found.</em></div>
        @endforelse
    </div>
</div>
@endsection
