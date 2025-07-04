<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesticide;
use Illuminate\Support\Facades\Auth;

class PesticideController extends Controller
{
    // 🔁 Determine which view to load based on authenticated user's role
    private function resolveView($view)
    {
        $role = Auth::user()?->role;
        return match ($role) {
            'admin' => "admin.pesticides.$view",
            'superadmin' => "superadmin.pesticides.$view",
            default => abort(403, 'Unauthorized access'),
        };
    }

    public function index(Request $request)
    {
        $pesticides = Pesticide::query();

        if ($request->filled('search')) {
            $pesticides->where('name', 'like', '%' . $request->search . '%');
        }

        $pesticides = $pesticides->get();

        return view($this->resolveView('index'), compact('pesticides'));
    }

    public function show($id)
    {
        $pesticide = Pesticide::findOrFail($id);
        return view($this->resolveView('show'), compact('pesticide'));
    }
    public function create()
    {
        return view($this->resolveView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'crop'              => 'required|string',
            'used_for'          => 'required|string|max:255',
            'active_ingredient' => 'required|string|max:255',
            'description'       => 'required|string',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/pesticides'), $imageName);

        Pesticide::create([
            'name'              => $request->name,
            'crop'              => $request->crop,
            'used_for'          => $request->used_for,
            'active_ingredient' => $request->active_ingredient,
            'description'       => $request->description,
            'image'             => $imageName,
        ]);

        $role = Auth::user()?->role;
        return redirect()->route($role . '.pesticides.index')->with('success', 'Pesticide added successfully.');
    }

    public function edit($id)
    {
        $pesticide = Pesticide::findOrFail($id);
        return view($this->resolveView('edit'), compact('pesticide'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'crop'              => 'required|string',
            'used_for'          => 'required|string|max:255',
            'active_ingredient' => 'required|string|max:255',
            'description'       => 'required|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pesticide = Pesticide::findOrFail($id);
        $data = $request->only(['name', 'crop', 'used_for', 'active_ingredient', 'description']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/pesticides'), $imageName);
            $data['image'] = $imageName;
        }

        $pesticide->update($data);

        return redirect()->route(Auth::user()->role . '.pesticides.index')->with('success', 'Pesticide updated successfully.');
    }

    public function destroy(string $id)
    {
        $pesticide = Pesticide::findOrFail($id);
        $pesticide->delete();

        return redirect()->route(Auth::user()->role . '.pesticides.index')->with('success', 'Pesticide deleted successfully.');
    }
}
