@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Farmers Report List</h4>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.reports.index') }}" class="row mb-4">
        <div class="col-md-10">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <!-- Users Table -->
    @if($users->count())
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Mobile</th>
                    <th>Barangay</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->mobile_number }}</td>
                        <td>{{ $user->perm_address_barangay }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <a href="{{ route('admin.reports.show', $user->id) }}" class="btn btn-sm btn-success">View Report</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $users->links() }}
    @else
        <p>No users found.</p>
    @endif
</div>
@endsection
