<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;
use App\Models\CropType;
use App\Models\Variety;
use App\Models\Corn;
use App\Models\Rice;
use App\Models\Fertilizer;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CropMonitoringController extends Controller
{
    private function getRolePrefix()
    {
        return Auth::user()->role === 'admin' ? 'admin' : 'superadmin';
    }

    // Show filtered user list for cropmonitoring
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

        // Optionally filter by role if you only want farmers:
        $query->where('role', 'farmer');

        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $viewPrefix = $this->getRolePrefix();

        return view("{$viewPrefix}.cropmonitoring.index", compact('users'));
    }

    // Show detailed planting activities for a specific farmer
    public function viewPlantingDetails($id)
    {
        $user = User::findOrFail($id);

        $plantingSteps = [
            'Planting Seed',
            'Germination',
            'Lipat Tanim',
            'Watering',
            'Fertilizing',
            'Pest Control',
            'Harvesting'
        ];

        $activities = Report::where('user_id', $id)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->season ?? (
                    (Str::contains(Str::lower(Carbon::parse($item->date)->format('F')), ['nov', 'dec', 'jan', 'feb', 'mar', 'apr'])
                        ? 'Dry Season ' : 'Wet Season ') . Carbon::parse($item->date)->format('Y')
                );
            });

        $viewPrefix = $this->getRolePrefix();

        return view("{$viewPrefix}.cropmonitoring.plantingdetails", compact('user', 'plantingSteps', 'activities'));
    }

    public function create($userId)
    {
        $user = User::findOrFail($userId);
        $crops = ['rice', 'corn'];

        // Get all corn and rice variety names
        $cornVarieties = Corn::pluck('name')->toArray();
        $riceVarieties = Rice::pluck('name')->toArray();
        $fertilizerTypes = Fertilizer::pluck('name')->toArray(); // <-- get from DB

        $seasons = ['Dry Season', 'Wet Season'];
        $plantingSteps = [
            'Planting Seed',
            'Germination',
            'Lipat Tanim',
            'Watering',
            'Fertilizing',
            'Pest Control',
            'Harvesting'
        ];
        $viewPrefix = $this->getRolePrefix();

        return view("{$viewPrefix}.cropmonitoring.create", compact(
            'user', 'crops', 'cornVarieties', 'riceVarieties', 'fertilizerTypes', 'seasons', 'plantingSteps'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'crop' => 'required|string',
            'variety' => 'required|string',
            'season' => 'required|string',
            'step_name' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string',
            'fertilizer_count' => 'required|integer|min:0',
            'fertilizer_type' => 'required|string',
        ]);

        Report::create($validated);

        $routePrefix = $this->getRolePrefix();
        return redirect()->route("{$routePrefix}.cropmonitoring.index")->with('success', 'Planting activity added successfully.');
    }

    public function edit($activityId)
    {
        $activity = Report::find($activityId); // Use Report model, not CropMonitoring
        if (!$activity) {
            abort(404);
        }

        $plantingSteps = [
            'Planting Seed',
            'Germination',
            'Lipat Tanim',
            'Watering',
            'Fertilizing',
            'Pest Control',
            'Harvesting'
        ];
        $seasons = ['Dry Season', 'Wet Season'];
        $user = $activity->user;

        $crops = ['rice', 'corn'];

        // Get all corn and rice variety names
        $cornVarieties = Corn::pluck('name')->toArray();
        $riceVarieties = Rice::pluck('name')->toArray();
        $varieties = array_merge($cornVarieties, $riceVarieties);

        $viewPrefix = $this->getRolePrefix();

        return view("{$viewPrefix}.cropmonitoring.edit", compact(
            'activity', 'plantingSteps', 'seasons', 'user', 'crops', 'varieties'
        ));
    }

    public function update(Request $request, Report $activity)
    {
        $activity->update($request->all());
        $routePrefix = $this->getRolePrefix();

        return redirect()->route("{$routePrefix}.cropmonitoring.plantingdetails", $activity->user_id)
            ->with('success', 'Activity updated successfully.');
    }
}
