@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h4>Edit Planting Activity for {{ $user->first_name }} {{ $user->last_name }}</h4>

    <form action="{{ route('superadmin.cropmonitoring.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="crop" class="form-label">What kind of crop?</label>
            <select name="crop" id="crop" class="form-control" required {{ empty($crops) ? 'disabled' : '' }}>
                @if(empty($crops))
                    <option value="">No crop info available</option>
                @else
                    @foreach ($crops as $crop)
                        <option value="{{ $crop }}" {{ $activity->crop === $crop ? 'selected' : '' }}>{{ $crop }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="variety" class="form-label">Variety</label>
            <select name="variety" id="variety" class="form-control" required {{ empty($varieties) ? 'disabled' : '' }}>
                @if(empty($varieties))
                    <option value="">No variety info available</option>
                @else
                    @foreach ($varieties as $variety)
                        <option value="{{ $variety }}" {{ $activity->variety === $variety ? 'selected' : '' }}>{{ $variety }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="season" class="form-label">Season</label>
            <select name="season" id="season" class="form-control" required>
                @foreach ($seasons as $season)
                    <option value="{{ $season }}" {{ $activity->season === $season ? 'selected' : '' }}>{{ $season }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="step_name" class="form-label">Step</label>
            <select name="step_name" id="step_name" class="form-control" required>
                @foreach ($plantingSteps as $step)
                    <option value="{{ $step }}" {{ $activity->step_name === $step ? 'selected' : '' }}>{{ $step }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d', strtotime($activity->date)) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $activity->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fertilizer_count" class="form-label">How many times fertilizer was used?</label>
            <input type="number" name="fertilizer_count" id="fertilizer_count" class="form-control" value="{{ $activity->fertilizer_count }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="fertilizer_type" class="form-label">Type of fertilizer used</label>
            <input type="text" name="fertilizer_type" id="fertilizer_type" class="form-control" value="{{ $activity->fertilizer_type }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Activity</button>
        <a href="{{ route('superadmin.cropmonitoring.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
