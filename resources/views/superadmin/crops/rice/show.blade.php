@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h4>Rice Variety Details</h4>

    <div class="card">
        <div class="card-body">
            <h5>{{ $rice->name }}</h5>
            <p>{{ $rice->description }}</p>
            @if($rice->image)
                <img src="{{ asset('images/rice/' . $rice->image) }}" alt="{{ $rice->name }}" style="width: 200px;">
            @else
                <p><i>No image uploaded.</i></p>
            @endif
        </div>
    </div>

    <a href="{{ route('rice-varieties.edit', $rice->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('crop-types.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
