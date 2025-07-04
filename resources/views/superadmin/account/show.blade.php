@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('superadmin.account.index') }}" class="btn btn-secondary btn-sm">&larr; Back to List</a>
    </div>
    <div class="card shadow border border-2" style="border-radius: 12px;">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $admin->first_name }} {{ $admin->last_name }}</h4>
            <p><strong>Username:</strong> {{ $admin->username }}</p>
            <p><strong>First Name:</strong> {{ $admin->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $admin->last_name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($admin->role) }}</p>
            <p><strong>Created At:</strong> {{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '-' }}</p>
            <p><strong>Updated At:</strong> {{ $admin->updated_at ? $admin->updated_at->format('Y-m-d') : '-' }}</p>
            <div class="mt-4">
                <a href="{{ route('superadmin.account.edit', $admin->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                <a href="{{ route('superadmin.account.index') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection