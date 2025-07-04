<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rice;
class RiceController extends Controller
{
    public function create()
{
    return view('rice.create');
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
        $imagePath = $request->file('image')->store('rice', 'public');
        $data['image'] = basename($imagePath);
    }

    Rice::create($data);

    return redirect()->route('crop-types.index')->with('success', 'Rice variety added.');
}

public function edit($id)
{
    $rice = Rice::findOrFail($id);
    return view('rice.edit', compact('rice'));
}

public function update(Request $request, $id)
{
    $rice = Rice::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'description']);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('rice', 'public');
        $data['image'] = basename($imagePath);
    }

    $rice->update($data);

    return redirect()->route('crop-types.index')->with('success', 'Rice variety updated.');
}

public function show($id)
{
    $rice = Rice::findOrFail($id);
    return view('rice.show', compact('rice'));
}
}
