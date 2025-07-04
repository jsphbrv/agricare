<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rice;
use App\Models\Corn;
use App\Models\CropType;

class CropTypeController extends Controller
{
    public function index()
    {
        $riceTypes = Rice::all();
        $cornTypes = Corn::all();

        $role = Auth::guard('admin')->user()->role;
        $viewPath = $role === 'superadmin' ? 'superadmin.crops.index' : 'admin.crops.index';

        return view($viewPath, compact('riceTypes', 'cornTypes'));
    }

    public function showAllCropTypes(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $riceTypes = collect();
        $cornTypes = collect();

        if (!$type || $type === 'rice') {
            $riceQuery = Rice::query();
            if ($search) {
                $riceQuery->where('name', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%");
            }
            $riceTypes = $riceQuery->get();
        }

        if (!$type || $type === 'corn') {
            $cornQuery = Corn::query();
            if ($search) {
                $cornQuery->where('name', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%");
            }
            $cornTypes = $cornQuery->get();
        }

        $role = Auth::guard('admin')->user()->role;
        $viewPath = $role === 'superadmin' ? 'superadmin.crops.index' : 'admin.crops.index';

        return view($viewPath, compact('riceTypes', 'cornTypes'));
    }

    public function show(Request $request, $id)
    {
        $type = $request->input('type');
        $role = Auth::guard('admin')->user()->role;

        if ($type === 'corn') {
            $variety = Corn::findOrFail($id);
            $folder = 'corn';
        } else {
            $variety = Rice::findOrFail($id);
            $type = 'rice';
            $folder = 'rice';
        }

        $viewPath = $role === 'superadmin'
            ? "superadmin.{$type}.show"
            : "admin.{$type}.show";

        return view($viewPath, compact('variety', 'type', 'folder'));
    }
}
