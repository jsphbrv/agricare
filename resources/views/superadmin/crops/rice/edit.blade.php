@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h4>Edit Rice Variety</h4>

    <form action="{{ route('rice-varieties.update', $rice->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Variety Name</label>
            <input type="text" name="name" class="form-control" value="{{ $rice->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description">Variety Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $rice->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image">Replace Image (optional)</label>
            <input type="file" name="image" class="form-control">
            @if($rice->image)
                <div class="mt-2">
                    <img src="{{ asset('images/rice/' . $rice->image) }}" alt="" style="width: 120px;">
                </div>
            @endif
        </div>

        <button class="btn btn-primary">Update Variety</button>
    </form>
</div>
@endsection
