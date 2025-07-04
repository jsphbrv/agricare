@extends('layouts.admin')

@section('content')
<!-- Include Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    padding: 0 20px 20px;
    justify-content: center;
  }

  .card {
    background-color: #4CAF50;
    color: white;
    width: 250px;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s;
    position: relative;
  }

  .card:hover {
    transform: translateY(-5px);
  }

  .card i {
    font-size: 40px;
    margin-bottom: 15px;
  }

  @media (max-width: 768px) {
    .card {
      width: 100%;
    }
  }
</style>

<div class="top-bar"></div>

<div class="dashboard-content">
  <div class="card" title="Total number of registered farmers">
    <i class="fas fa-user" aria-label="Farmers"></i><br>
    <h4>{{ $totalFarmers }}</h4>
    Farmers
  </div>
  <div class="card" title="Total number of rice varieties">
    <i class="fas fa-leaf" aria-label="Rice Varieties"></i><br>
    <h4>{{ $totalRiceVarieties }}</h4>
    Rice Varieties
  </div>
  <div class="card" title="Total number of corn varieties">
    <i class="fas fa-seedling" aria-label="Corn Varieties"></i><br>
    <h4>{{ $totalCornVarieties }}</h4>
    Corn Varieties
  </div>
</div>

<div class="container mt-5">
  <h5>User Registrations (Past Year)</h5>
  <canvas id="registrationsChart" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('registrationsChart').getContext('2d');
  const registrationsChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: @json($chartLabels),
          datasets: [{
              label: 'Registrations',
              data: @json($chartData),
              borderColor: '#007bff',
              backgroundColor: 'rgba(0,123,255,0.1)',
              fill: true,
              tension: 0.3
          }]
      },
      options: {
          responsive: true,
          scales: {
              y: { beginAtZero: true }
          }
      }
  });
</script>
@endsection
