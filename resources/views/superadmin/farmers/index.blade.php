@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h4>User Management</h4>

    <!-- Notification -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter & Search Row -->
    <form method="GET" action="{{ route('superadmin.farmers.index') }}">
        <div class="row g-3 align-items-end mb-3">

            <div class="col-md-3">
                <label for="search" class="form-label">Search by Name</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="e.g. Juan Dela Cruz">
            </div>

            <div class="col-md-2">
                <label for="from" class="form-label">From Date</label>
                <input type="date" name="from" id="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <label for="to" class="form-label">To Date</label>
                <input type="date" name="to" id="to" value="{{ request('to') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>

            <div class="col-md-1">
                <a href="{{ route('superadmin.farmers.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>

            <div class="col-md-2 text-end">
                <a href="{{ route('superadmin.farmers.create') }}" class="btn btn-success w-100">+ Add User</a>
            </div>

        </div>
    </form>

    <!-- User Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->mobile_number }}</td>
                    <td>{{ $user->address }}</td>
                    <td><span class="text-success fw-bold">{{ $user->status }}</span></td>
                    <td>
                        <a href="{{ route('superadmin.farmers.show', $user->id) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('superadmin.farmers.edit', $user->id) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('superadmin.farmers.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to archive this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-warning" type="submit">Archive</button>
                        </form>
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
