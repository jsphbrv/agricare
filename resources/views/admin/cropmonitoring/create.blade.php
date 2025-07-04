@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Add Planting Activity for {{ $user->first_name }} {{ $user->last_name }}</h4>

    <form action="{{ route('admin.cropmonitoring.store') }}" method="POST">
        @csrf

        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="mb-3">
            <label for="crop" class="form-label">What kind of crop?</label>
            <select name="crop" id="cropType" class="form-select" required>
                <option value="">Select Crop</option>
                @foreach($crops as $crop)
                    <option value="{{ $crop }}">{{ ucfirst($crop) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="variety" class="form-label">Variety</label>
            <select name="variety" id="variety" class="form-control" required>
                <option value="">Select Variety</option>
                @foreach ($riceVarieties as $variety)
                    <option value="{{ $variety }}" data-type="rice">{{ $variety }}</option>
                @endforeach
                @foreach ($cornVarieties as $variety)
                    <option value="{{ $variety }}" data-type="corn">{{ $variety }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="season" class="form-label">Season</label>
            <select name="season" id="season" class="form-control" required>
                <option value="" disabled selected>Select Season</option>
                @foreach ($seasons as $season)
                    <option value="{{ $season }}">{{ $season }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="step_name" class="form-label">Step</label>
            <select name="step_name" id="step_name" class="form-control" required>
                <option value="" disabled selected>Select Step</option>
                @foreach ($plantingSteps as $step)
                    <option value="{{ $step }}">{{ $step }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>

        {{-- New Fertilizer Usage Fields --}}
        <div class="mb-3">
            <label for="fertilizer_count" class="form-label">How many times fertilizer was used?</label>
            <input type="number" name="fertilizer_count" id="fertilizer_count" class="form-control" min="0" value="0" required>
        </div>

        <div class="mb-3">
            <label for="fertilizer_type" class="form-label">Type of fertilizer used</label>
            <select name="fertilizer_type" id="fertilizer_type" class="form-control" required>
                <option value="">Select Fertilizer Type</option>
                @foreach($fertilizerTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
                <option value="N/A">N/A</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Activity</button>
        <a href="{{ route('admin.cropmonitoring.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cropType = document.getElementById('cropType');
    const varietySelect = document.getElementById('variety');
    const allOptions = Array.from(varietySelect.options);

    cropType.addEventListener('change', function () {
        const selectedType = this.value;
        varietySelect.innerHTML = '<option value="">Select Variety</option>';
        allOptions.forEach(option => {
            if (option.value === "") return;
            if (option.getAttribute('data-type') === selectedType) {
                varietySelect.appendChild(option.cloneNode(true));
            }
        });
    });
});
</script>
@endsection
