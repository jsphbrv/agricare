<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Planting Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h3, h4 { margin-bottom: 0; }
        .section { margin-bottom: 25px; }
        .step { margin-top: 10px; }
        .line { border-bottom: 1px solid #ccc; margin: 5px 0; }
    </style>
</head>
<body>
    <h3>Planting Report</h3>
    <h4>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h4>

    <div class="section">
        <strong>RSBSA No:</strong> {{ $user->rsbsa_ref_no }}<br>
        <strong>Address:</strong> {{ $user->perm_address_street }}, {{ $user->perm_address_barangay }}, {{ $user->perm_city }}, {{ $user->perm_province }}<br>
        <strong>Farm Area:</strong> {{ $user->total_farm_area }} hectares
    </div>

    @forelse ($activities as $season => $seasonActivities)
        <div class="section">
            <strong style="font-size: 14px;">Season: {{ $season }}</strong>

            @foreach ($plantingSteps as $step)
                @php $stepActivities = $seasonActivities->where('step_name', $step); @endphp

                @if ($stepActivities->isNotEmpty())
                    <div class="step">
                        <u><strong>{{ $step }}</strong></u>
                        <ul>
                            @foreach ($stepActivities as $activity)
                                <li>
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($activity->date)->format('F d, Y') }}<br>
                                    <strong>Description:</strong> {{ $activity->description ?? 'N/A' }}<br>
                                    @if($activity->fertilizer_type)
                                        <strong>Fertilizer:</strong> {{ $activity->fertilizer_type }} ({{ $activity->fertilizer_count ?? 0 }})
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    @empty
        <p>No planting activity found.</p>
    @endforelse

    <hr>
    <p><em>Report generated on {{ \Carbon\Carbon::now()->format('F d, Y') }}</em></p>
</body>
</html>
