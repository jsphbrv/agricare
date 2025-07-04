@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 800px;">
    <h3 class="text-center mb-4">Farmer Details</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Personal Information --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Full Name:</strong><br>
                    {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->suffix }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Sex:</strong> {{ $user->gender }}</p>
                    <p><strong>Civil Status:</strong> {{ $user->civil_status ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- ID and Farm Info --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>RSBSA Reference No.:</strong> {{ $user->rsbsa_ref_no ?? 'N/A' }}</p>
                    <p><strong>ID Type:</strong> {{ $user->id_name ?? 'N/A' }}</p>
                    <p><strong>ID Number:</strong> {{ $user->id_number ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Farm Area:</strong> {{ $user->total_farm_area ?? 0 }} hectares</p>
                </div>
            </div>

            {{-- Address --}}
            <div class="mb-3">
                <p><strong>Permanent Address 1:</strong> {{ $user->perm_address_street ?? 'N/A' }}</p>
                <p><strong>Permanent Address 2:</strong> {{ $user->perm_address_line2 ?? 'N/A' }}</p>
                <p><strong>Barangay:</strong> {{ $user->perm_address_barangay ?? 'N/A' }}</p>
                <p><strong>City:</strong> {{ $user->perm_city ?? 'N/A' }}</p>
                <p><strong>Province:</strong> {{ $user->perm_province ?? 'N/A' }}</p>
            </div>

            {{-- Birth and Religion --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Birthdate:</strong> {{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') : 'N/A' }}</p>
                    <p><strong>Birthplace:</strong> {{ $user->birthplace ?? 'N/A' }}</p>
                    <p><strong>Religion:</strong> {{ $user->religion ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    @if ($user->civil_status === 'Married')
                        <p><strong>Name of Spouse:</strong> {{ $user->name_of_spouse ?? 'N/A' }}</p>
                    @endif
                    <p><strong>Highest Formal Education:</strong> {{ $user->highest_formal_education ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Other Details --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nationality:</strong> {{ $user->nationality ?? 'N/A' }}</p>
                    <p><strong>Profession:</strong> {{ $user->profession ?? 'N/A' }}</p>
                    <p><strong>Source of Funds:</strong> {{ $user->source_of_funds ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Mother's Maiden Name:</strong> {{ $user->mothers_maiden_name ?? 'N/A' }}</p>
                    <p><strong>Emboss Name:</strong> {{ $user->emboss_name ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Contact --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Mobile Number:</strong> {{ $user->mobile_number ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Account Info --}}
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Status:</strong> {{ $user->status }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    <p><strong>Registered At:</strong> {{ $user->created_at ? $user->created_at->format('F d, Y h:i A') : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.farmers.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
