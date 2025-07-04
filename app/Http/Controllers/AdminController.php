<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rice;
use App\Models\Corn;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Count of registered farmers
        $totalFarmers = User::where('role', 'farmer')->count();

        // Count of crop varieties
        $totalRiceVarieties = Rice::count();
        $totalCornVarieties = Corn::count();

        // User registrations for the past year (by month)
        $yearly = User::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw('count(*) as count')
        )
        ->where('role', 'farmer')
        ->where('created_at', '>=', Carbon::now()->subYear())
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        // Additional: Daily and Monthly Count (Optional)
        $dailyCount = User::where('role', 'farmer')
                        ->whereDate('created_at', Carbon::today())
                        ->count();

        $monthlyCount = User::where('role', 'farmer')
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->count();

        $totalAdmins = User::whereIn('role', ['admin', 'admin'])->count();

        // Build a continuous array of months for the past year
        $months = [];
        $start = Carbon::now()->subMonths(11)->startOfMonth();
        for ($i = 0; $i < 12; $i++) {
            $monthKey = $start->format('Y-m');
            $months[$monthKey] = 0;
            $start->addMonth();
        }

        // Fill with actual data
        foreach ($yearly as $month => $count) {
            $months[$month] = $count;
        }

        // Prepare for chart.js (labels and data)
        $chartLabels = array_map(function($m) {
            return Carbon::createFromFormat('Y-m', $m)->format('M Y');
        }, array_keys($months));
        $chartData = array_values($months);

        return view('admin.dashboard', compact(
            'totalFarmers',
            'totalRiceVarieties',
            'totalCornVarieties',
            'yearly',
            'dailyCount',
            'monthlyCount',
            'totalAdmins',
            'chartLabels',
            'chartData'
        ));
    }
}
