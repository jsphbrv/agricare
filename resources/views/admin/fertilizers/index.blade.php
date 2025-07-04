@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Fertilizer Management</h4>
        <a href="{{ route('admin.fertilizers.create') }}" class="btn btn-success">+ Add Fertilizer</a>
    </div>

    <form method="GET" action="{{ route('admin.fertilizers.index') }}" class="mb-3">
        <div class="input-group">
            <span class="input-group-text">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" name="search" class="form-control" placeholder="Search fertilizer..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fertilizers as $fertilizer)
                    <tr>
                        <td>
                            @if($fertilizer->image)
                                <img src="{{ asset('images/fertilizers/' . $fertilizer->image) }}" alt="{{ $fertilizer->name }}" style="height: 60px; width: 60px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $fertilizer->name }}</td>
                        <td>
                            <a href="{{ route('admin.fertilizers.show', $fertilizer->id) }}" class="btn btn-sm btn-info">Show</a>
                            <a href="{{ route('admin.fertilizers.edit', $fertilizer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No fertilizers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
