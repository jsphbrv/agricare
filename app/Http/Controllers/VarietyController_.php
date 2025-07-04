<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rice;
use App\Models\Corn;

class VarietyController_ extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $type = $request->type;

        $riceTypes = Rice::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        })->get();

        $cornTypes = Corn::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        })->get();

        $user = auth('admin')->user();
        $view = ($user && $user->role === 'admin')
            ? 'admin.varieties.index'
            : 'superadmin.varieties.index';

        return view($view, compact('riceTypes', 'cornTypes'));
    }

    public function create()
    {
        $user = auth('admin')->user();
        $view = ($user && $user->role === 'admin')
            ? 'admin.varieties.create'
            : 'superadmin.varieties.create';

        return view($view);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:rice,corn',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/' . $validated['type']), $filename);
        }

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $filename,
        ];

        if ($validated['type'] == 'rice') {
            Rice::create($data);
        } else {
            Corn::create($data);
        }

        $user = auth('admin')->user();
        $route = ($user && $user->role === 'admin')
            ? 'admin.varieties.index'
            : 'superadmin.varieties.index';

        return redirect()->route($route)->with('success', 'Variety added successfully.');
    }

    public function edit($id)
    {
        $variety = Rice::find($id) ?? Corn::find($id);
        if (!$variety) {
            abort(404);
        }

        $user = auth('admin')->user();
        $view = ($user && $user->role === 'admin')
            ? 'admin.varieties.edit'
            : 'superadmin.varieties.edit';

        return view($view, compact('variety'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|in:rice,corn',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $model = $validated['type'] === 'rice' ? Rice::find($id) : Corn::find($id);

        if (!$model) {
            abort(404);
        }

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($model->image) {
                $oldPath = public_path('images/' . $validated['type'] . '/' . $model->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/' . $validated['type']), $filename);
            $model->image = $filename;
        }

        $model->name = $validated['name'];
        $model->description = $validated['description'];
        $model->save();

        $user = auth('admin')->user();
        $route = ($user && $user->role === 'admin')
            ? 'admin.varieties.index'
            : 'superadmin.varieties.index';

        return redirect()->route($route)->with('success', 'Variety updated successfully.');
    }

    public function show($id)
    {
        $variety = Rice::find($id) ?? Corn::find($id);
        if (!$variety) {
            abort(404);
        }

        $user = auth('admin')->user();
        $view = ($user && $user->role === 'admin')
            ? 'admin.varieties.show'
            : 'superadmin.varieties.show';

        return view($view, compact('variety'));
    }
}
