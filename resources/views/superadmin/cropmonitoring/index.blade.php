@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h4>Crop Monitoring</h4>

    <!-- Notification -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter & Search -->
    <form action="{{ route('superadmin.cropmonitoring.index') }}" method="GET" class="row g-3 mb-3">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4 text-end">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Report Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Date Registered</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td><span class="text-success fw-bold">{{ $user->status }}</span></td>
                    <td>{{ $user->created_at->format('F d, Y') }}</td>
                    <td>
                        <a href="{{ route('superadmin.cropmonitoring.plantingdetails', $user->id) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('superadmin.cropmonitoring.edit', $user->id) }}" class="btn btn-sm btn-success">Edit</a>
                        <a href="{{ route('superadmin.cropmonitoring.create', $user->id) }}" class="btn btn-sm btn-success">Add</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
