@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Planting History for {{ $user->first_name }} {{ $user->last_name }}</h4>

    @forelse ($activities as $season => $seasonActivities)
        <div class="mb-5">
            <h5 class="bg-primary text-white p-2 rounded">{{ $season }}</h5>

            @foreach ($plantingSteps as $step)
                @php
                    $stepData = $seasonActivities->where('step_name', $step);
                    // Indicator: completed if there is at least one activity for this step
                    $completed = $stepData->count() > 0;
                @endphp
                <div class="card mb-2 border-{{ $completed ? 'success' : 'secondary' }}">
                    <div class="card-header d-flex justify-content-between align-items-center {{ $completed ? 'bg-success' : 'bg-secondary' }} text-white">
                        <span>{{ $step }}</span>
                        <span>
                            @if($completed)
                                <span class="badge bg-light text-success"><i class="bi bi-check-circle-fill"></i> Completed</span>
                            @else
                                <span class="badge bg-light text-secondary"><i class="bi bi-clock"></i> Pending</span>
                            @endif
                        </span>
                    </div>
                    <div class="card-body">
                        @if($completed)
                            @foreach ($stepData as $activity)
                                <div class="mb-2">
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($activity->date)->format('F d, Y') }}<br>
                                    <strong>Description:</strong> {{ $activity->description }}
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <p class="text-muted">No records for this step.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p>No planting activities found for this farmer.</p>
    @endforelse

    <div class="text-end">
        <a href="{{ route('admin.cropmonitoring.index') }}" class="btn btn-secondary">← Back to CropMonitoring</a>
    </div>
</div>
@endsection
