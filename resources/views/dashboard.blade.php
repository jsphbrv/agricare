@extends('layouts.admin')

@section('content')
<style>
    .top-bar {
        background: #FF9800;
        height: 30px;
        width: 100%;
        border-bottom: 2px solid #e68900;
        margin-bottom: 24px;
    }

    .dashboard-content {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        padding: 0 20px 20px 20px;
    }

    .card {
        background-color: #4CAF50;
        color: white;
        width: 250px;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: transform 0.3s;
        position: relative;
    }

    .card:hover {
        transform: translateY(-5px);
        text-decoration: none;
        color: white;
    }

    .card i {
        font-size: 40px;
        margin-bottom: 15px;
    }
</style>

<!-- Orange Bar -->
<div class="top-bar"></div>

<!-- Dashboard Icons -->
<div class="dashboard-content">
    <a href="{{ route('admin.farmers.index') }}" class="card">
        <i class="fa fa-user"></i><br>Farmer
    </a>
    <a href="{{ route('admin.crops.index') }}" class="card">
        <i class="fa fa-leaf"></i><br>Crops
    </a>
    <a href="{{ route('admin.pests.index') }}" class="card">
        <i class="fa fa-bug"></i><br>Pest
    </a>
    <a href="{{ route('admin.pesticides.index') }}" class="card">
        <i class="fa fa-flask"></i><br>Pesticide
    </a>
    <a href="{{ route('admin.fertilizers.index') }}" class="card">
        <i class="fa fa-tint"></i><br>Fertilizer
    </a>
</div>
@endsection
