@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Pesticide Management</h4>
        <a href="{{ route('superadmin.pesticides.create') }}" class="btn btn-success">+ Add Pesticide</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('superadmin.pesticides.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search pesticide..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <h5 class="mt-4">Rice Pesticides</h5>
    <div class="table-responsive mb-4">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Crop</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesticides->where('crop', 'rice') as $pesticide)
                    <tr>
                        <td>
                            @if ($pesticide->image)
                                <img src="{{ asset('uploads/pesticides/' . $pesticide->image) }}" alt="{{ $pesticide->name }}" style="height: 60px; width: 60px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $pesticide->name }}</td>
                        <td>{{ ucfirst($pesticide->crop) }}</td>
                        <td>
                            <a href="{{ route('superadmin.pesticides.edit', $pesticide->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('superadmin.pesticides.show', $pesticide->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"><em>No rice pesticides found.</em></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h5 class="mt-4">Corn Pesticides</h5>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Crop</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesticides->where('crop', 'corn') as $pesticide)
                    <tr>
                        <td>
                            @if ($pesticide->image)
                                <img src="{{ asset('uploads/pesticides/' . $pesticide->image) }}" alt="{{ $pesticide->name }}" style="height: 60px; width: 60px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $pesticide->name }}</td>
                        <td>{{ ucfirst($pesticide->crop) }}</td>
                        <td>
                            <a href="{{ route('superadmin.pesticides.edit', $pesticide->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('superadmin.pesticides.show', $pesticide->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"><em>No corn pesticides found.</em></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
