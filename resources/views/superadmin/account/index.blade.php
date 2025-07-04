@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Admin Accounts</h4>
        <a href="{{ route('superadmin.account.create') }}" class="btn btn-success">+ Add Admin</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('superadmin.account.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name or email...">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    <!-- Admins Table -->
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr>
                        <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ ucfirst($admin->role) }}</td>
                        <td>{{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '-' }}</td>
                        <td>
                            <a href="{{ route('superadmin.account.edit', $admin->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('superadmin.account.show', $admin->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No admin accounts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination (if applicable) -->
    <div class="mt-3">
        {{ $admins->withQueryString()->links() }}
    </div>
</div>
@endsection
