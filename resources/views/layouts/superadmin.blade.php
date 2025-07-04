<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriCare Superadmin</title>

    <!-- Bootstrap 4.6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            overflow: hidden; /* Prevent double scroll */
        }

        .layout-container {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        .sidebar {
            width: 220px;
            background: #4CAF50;
            color: #fff;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1001;
            overflow-y: auto;
        }

        .sidebar .sidebar-title {
            padding: 20px 10px 5px 10px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        .sidebar .sidebar-title span:first-child {
            color:rgb(255, 255, 255);
        }

        .sidebar .superadmin-header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .superadmin-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .sidebar .superadmin-header span {
            font-size: 18px;
            font-weight: bold;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            flex-grow: 1;
        }

        .sidebar ul li {
            padding: 12px 20px;
            transition: background 0.3s;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar ul li:hover {
            background: #388E3C;
        }

        .sidebar ul li.active, .sidebar ul li.active a {
            background: #388E3C !important;
            color: #fff !important;
            font-weight: bold;
        }

        .main {
            margin-left: 220px;
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            padding: 30px;
            background-color: #f8f9fa;
        }

        /* Mobile View */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0 !important;
                padding-top: 70px;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .sidebar-toggle-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1100;
            background: #4CAF50;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<!-- Sidebar Toggle Button (Mobile Only) -->
<button onclick="toggleSidebar()" class="btn sidebar-toggle-btn d-md-none">
    <i class="fa fa-bars"></i>
</button>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

<div class="layout-container">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-title">
            <span>AGRICARE</span> ADMIN
        </div>
        <div class="superadmin-header">
            <img src="/images/admin-avatar.png" alt="Admin Avatar">
            <span>SUPERADMIN</span>
        </div>
        <ul>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.farmers.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.farmers.index') }}"><i class="fa fa-user"></i> Farmers</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.crops.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.crops.index') }}"><i class="fa fa-leaf"></i> Crops</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.cropmonitoring.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.cropmonitoring.index') }}"><i class="fa fa-file-text"></i> Crop Monitoring</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.pests.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pests.index') }}"><i class="fa fa-bug"></i> Pest</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.pesticides.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.pesticides.index') }}"><i class="fa fa-flask"></i> Pesticide</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.fertilizers.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.fertilizers.index') }}"><i class="fa fa-tint"></i> Fertilizer</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.reports.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.reports.index') }}"><i class="fa fa-file-text"></i> Report</a>
            </li>
            <li class="{{ request()->routeIs('superadmin.account.*') ? 'active' : '' }}">
                <a href="{{ route('superadmin.account.index') }}"><i class="fa fa-user-circle"></i> Account</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main">
        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebar-overlay').classList.remove('active');
        }
    });
</script>

</body>
</html>
