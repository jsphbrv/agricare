@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Planting Report for {{ $user->first_name }} {{ $user->last_name }}</h4>

    <div class="mb-3">
        <strong>RSBSA No:</strong> {{ $user->rsbsa_ref_no }} <br>
        <strong>Address:</strong> {{ $user->perm_address_street }}, {{ $user->perm_address_barangay }}, {{ $user->perm_city }}, {{ $user->perm_province }} <br>
        <strong>Farm Area:</strong> {{ $user->total_farm_area }} hectares
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.reports.pdf', $user->id) }}" class="btn btn-danger" target="_blank">
            <i class="fas fa-file-pdf"></i> Download PDF
        </a>
    </div>

    @forelse ($activities as $season => $seasonActivities)
        <div class="mb-5">
            <h5 class="bg-success text-white p-2 rounded">{{ $season }}</h5>

            @foreach ($plantingSteps as $step)
                @php
                    $stepActivities = $seasonActivities->where('step_name', $step);
                @endphp

                @if ($stepActivities->isNotEmpty())
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong>{{ $step }}</strong>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                @foreach ($stepActivities as $activity)
                                    <li>
                                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($activity->date)->format('F d, Y') }}<br>
                                        <strong>Description:</strong> {{ $activity->description ?? 'N/A' }}<br>
                                        @if($activity->fertilizer_type)
                                            <strong>Fertilizer:</strong> {{ $activity->fertilizer_type }} ({{ $activity->fertilizer_count ?? 0 }})
                                        @endif
                                    </li>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @empty
        <div class="alert alert-info">No planting activities found.</div>
    @endforelse

    <div class="text-center mt-4">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
