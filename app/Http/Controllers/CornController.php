<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corn;

class CornController extends Controller
{
    private function resolveView($view)
    {
        $role = auth('admin')->user()?->role;
        return match ($role) {
            'admin' => "admin.crops.corn.$view",
            'superadmin' => "superadmin.crops.corn.$view",
            default => abort(403, 'Unauthorized access'),
        };
    }

    public function create()
    {
        return view($this->resolveView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('corn', 'public');
            $data['image'] = basename($imagePath);
        }

        Corn::create($data);

        $role = auth('admin')->user()?->role;
        $route = $role === 'admin' ? 'admin.crop-types.index' : 'superadmin.crop-types.index';

        return redirect()->route($route)->with('success', 'Corn variety added.');
    }

    public function edit($id)
    {
        $corn = Corn::findOrFail($id);
        return view($this->resolveView('edit'), compact('corn'));
    }

    public function update(Request $request, $id)
    {
        $corn = Corn::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('corn', 'public');
            $data['image'] = basename($imagePath);
        }

        $corn->update($data);

        $role = auth('admin')->user()?->role;
        $route = $role === 'admin' ? 'admin.crop-types.index' : 'superadmin.crop-types.index';

        return redirect()->route($route)->with('success', 'Corn variety updated.');
    }

    public function show($id)
    {
        $corn = Corn::findOrFail($id);
        return view($this->resolveView('show'), compact('corn'));
    }
}
