@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Crop Varieties</h3>

    <!-- SEARCH + FILTER FORM -->
    <form method="GET" action="{{ route('superadmin.varieties.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search variety name or description..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">All Types</option>
                <option value="rice" {{ request('type') == 'rice' ? 'selected' : '' }}>Rice</option>
                <option value="corn" {{ request('type') == 'corn' ? 'selected' : '' }}>Corn</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('superadmin.varieties.create') }}" class="btn btn-success w-100">Add New Variety</a>
        </div>
    </form>

    {{-- RICE VARIETIES --}}
    @if($riceTypes->count() > 0 && (request('type') == 'rice' || !request('type')))
        <h4>Rice Varieties</h4>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riceTypes as $rice)
                        <tr>
                            <td>
                                <img src="{{ $rice->image ? asset('images/rice/' . $rice->image) : asset('images/rice/default.png') }}"
                                     alt="{{ $rice->name }}"
                                     style="width: 100px; height: 70px; object-fit: cover;">
                            </td>
                            <td>{{ $rice->name }}</td>
                            <td>{{ $rice->description }}</td>
                            <td>
                                <a href="{{ route('superadmin.varieties.show', ['variety' => $rice->id]) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('superadmin.varieties.edit', $rice->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- CORN VARIETIES --}}
    @if($cornTypes->count() > 0 && (request('type') == 'corn' || !request('type')))
        <h4>Corn Varieties</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cornTypes as $corn)
                        <tr>
                            <td>
                                <img src="{{ $corn->image ? asset('images/corn/' . $corn->image) : asset('images/corn/default.png') }}"
                                     alt="{{ $corn->name }}"
                                     style="width: 100px; height: 70px; object-fit: cover;">
                            </td>
                            <td>{{ $corn->name }}</td>
                            <td>{{ $corn->description }}</td>
                            <td>
                                <a href="{{ route('superadmin.varieties.show', ['variety' => $corn->id]) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('superadmin.varieties.edit', $corn->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($riceTypes->isEmpty() && $cornTypes->isEmpty())
        <p class="text-center">No crop varieties found.</p>
    @endif
</div>
@endsection
