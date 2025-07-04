<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fertilizer;
use Illuminate\Support\Facades\Storage;

class FertilizerController extends Controller
{
    private function resolveView($view)
    {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => "admin.fertilizers.$view",
            'superadmin' => "superadmin.fertilizers.$view",
            default => abort(403),
        };
    }

    public function index()
    {
        $fertilizers = Fertilizer::all();
        return view($this->resolveView('index'), compact('fertilizers'));
    }

    public function create()
    {
        return view($this->resolveView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'crop'              => 'required|string',
            'type'              => 'required|string',
            'nutrient_content'  => 'required|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public/fertilizers', $imageName);
        }

        Fertilizer::create([
            'name'             => $request->name,
            'description'      => $request->description,
            'crop'             => $request->crop,
            'type'             => $request->type,
            'nutrient_content' => $request->nutrient_content,
            'image'            => $imageName,
        ]);

        return redirect()->route(auth()->user()->role . '.fertilizers.index')
                         ->with('success', 'Fertilizer added successfully!');
    }

    public function show(string $id)
    {
        $fertilizer = Fertilizer::findOrFail($id);
        return view($this->resolveView('show'), compact('fertilizer'));
    }

    public function edit($id)
    {
        $fertilizer = Fertilizer::findOrFail($id);
        return view($this->resolveView('edit'), compact('fertilizer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'crop'              => 'required|string',
            'type'              => 'required|string',
            'nutrient_content'  => 'required|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fertilizer = Fertilizer::findOrFail($id);
        $fertilizer->fill($request->only(['name', 'description', 'crop', 'type', 'nutrient_content']));

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('public/fertilizers', $filename);
            $fertilizer->image = $filename;
        }

        $fertilizer->save();

        return redirect()->route(auth()->user()->role . '.fertilizers.index')
                         ->with('success', 'Fertilizer updated successfully!');
    }

    public function destroy($id)
    {
        $fertilizer = Fertilizer::findOrFail($id);

        // Optional: Delete image file if exists
        if ($fertilizer->image && Storage::exists('public/fertilizers/' . $fertilizer->image)) {
            Storage::delete('public/fertilizers/' . $fertilizer->image);
        }

        $fertilizer->delete();

        return redirect()->route(auth()->user()->role . '.fertilizers.index')
                         ->with('success', 'Fertilizer deleted successfully!');
    }
}
