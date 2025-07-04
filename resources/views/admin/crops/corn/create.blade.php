@extends('layouts.superadmin')

@section('content')
<div class="container mt-4">
    <h4>Add New Rice Variety</h4>

    <form action="{{ route('rice-varieties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name">Variety Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description">Variety Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="image">Variety Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Add Variety</button>
    </form>
</div>
@endsection
