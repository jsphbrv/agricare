<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlantingActivity;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // ✅ LIST all farmers for report viewing (with search/filter)
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view($this->resolveView('index'), compact('users'));
    }

    // ✅ SHOW detailed planting report for a specific user
    public function show($id)
    {
        $user = User::with('plantingActivities')->findOrFail($id);

        $activities = $user->plantingActivities
            ->sortBy([
                ['season', 'asc'],
                ['step_name', 'asc'],
                ['date', 'asc']
            ])
            ->groupBy('season');

        $plantingSteps = [
            'Land Preparation', 'Seed Selection', 'Planting',
            'Fertilizer Application', 'Irrigation', 'Weeding',
            'Pest and Disease Control', 'Harvesting'
        ];

        return view($this->resolveView('show'), compact('user', 'activities', 'plantingSteps'));
    }

    // ✅ GENERATE PDF version of planting report
    public function generatePdf($id)
    {
        $user = User::with('plantingActivities')->findOrFail($id);

        $activities = $user->plantingActivities
            ->sortBy([
                ['season', 'asc'],
                ['step_name', 'asc'],
                ['date', 'asc']
            ])
            ->groupBy('season');

        $plantingSteps = [
            'Land Preparation', 'Seed Selection', 'Planting',
            'Fertilizer Application', 'Irrigation', 'Weeding',
            'Pest and Disease Control', 'Harvesting'
        ];

        $pdf = Pdf::loadView($this->resolveView('pdf'), compact('user', 'activities', 'plantingSteps'))
                 ->setPaper('A4', 'portrait');

        return $pdf->stream("planting_report_{$user->last_name}.pdf");
    }

    private function resolveView($view)
    {
        $role = auth('admin')->user()?->role;
        return match ($role) {
            'admin' => "admin.reports.$view",
            'superadmin' => "superadmin.reports.$view",
            default => abort(403, 'Unauthorized access'),
        };
    }
}
