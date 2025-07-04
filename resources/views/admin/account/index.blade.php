@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Admin Accounts</h4>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.account.index') }}" class="mb-3">
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
                            <a href="{{ route('admin.account.edit', $admin->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="{{ route('admin.account.show', $admin->id) }}" class="btn btn-sm btn-info">View</a>
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
</div>
@endsection
