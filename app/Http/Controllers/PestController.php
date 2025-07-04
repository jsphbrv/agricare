<?php

namespace App\Http\Controllers;

use App\Models\Pesticide;
use App\Models\Pest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PestController extends Controller
{
    // Automatically pick view based on role
    private function resolveView($view)
    {
        $user = Auth::user(); // Use the facade instead of the helper
        $role = $user ? $user->role : null;
        return match ($role) {
            'admin' => "admin.pests.$view",
            'superadmin' => "superadmin.pests.$view",
            default => abort(403, 'Unauthorized access'),
        };
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $ricePests = Pest::where('crop', 'rice')
            ->when($search, function($query, $search) {
                $query->where('common_name', 'like', "%$search%")
                      ->orWhere('scientific_name', 'like', "%$search%");
            })->get();

        $cornPests = Pest::where('crop', 'corn')
            ->when($search, function($query, $search) {
                $query->where('common_name', 'like', "%$search%")
                      ->orWhere('scientific_name', 'like', "%$search%");
            })->get();

        return view($this->resolveView('index'), compact('ricePests', 'cornPests'));
    }

    public function create()
    {
        $pesticides = Pesticide::all();
        return view($this->resolveView('create'), compact('pesticides'));
    }

    public function edit($id)
    {
        $pest = Pest::findOrFail($id);
        $pesticides = Pesticide::all();
        return view($this->resolveView('edit'), compact('pest', 'pesticides'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'common_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
            'crop' => 'required|string|max:50',
            'pesticide_id' => 'nullable|exists:pesticides,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/pests'), $imageName);
            $validated['image'] = $imageName;
        }

        Pest::create($validated);

        return redirect()->route(Auth::user()->role . '.pests.index')->with('success', 'Pest added successfully.');
    }
    public function update(Request $request, $id)
    {
        $pest = Pest::findOrFail($id);

        $validated = $request->validate([
            'common_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
            'crop' => 'required|string',
            'pesticide_id' => 'nullable|exists:pesticides,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/pests'), $imageName);
            $validated['image'] = $imageName;
        }

        $pest->update($validated);

        // Redirect to the correct index page based on role
        $role = Auth::user()->role;
        return redirect()
            ->route($role . '.pests.index')
            ->with('success', 'Pest updated successfully!');
    }
}
