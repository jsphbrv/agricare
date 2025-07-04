<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('admin')->user();

        if ($user->role === 'superadmin') {
            $search = $request->input('search');
            $admins = Admin::whereIn('role', ['admin', 'superadmin'])
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('username', 'like', "%{$search}%");
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('superadmin.account.index', compact('admins'));
        }

        // Admin: only self, as a collection (no pagination)
        $admins = collect([$user]);
        return view('admin.account.index', compact('admins'));
    }

    public function archived(Request $request)
    {
        $user = auth('admin')->user();
        if ($user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $search = $request->input('search');
        $admins = Admin::onlyTrashed()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('superadmin.account.archived', compact('admins'));
    }

    public function restore($id)
    {
        $user = auth('admin')->user();
        if ($user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $admin = Admin::onlyTrashed()->findOrFail($id);
        $admin->restore();

        return redirect()->route('superadmin.account.index')->with('success', 'Admin restored successfully.');
    }

    public function create()
    {
        $user = auth('admin')->user();
        if ($user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }
        return view('superadmin.account.create');
    }

    public function store(Request $request)
    {
        $user = auth('admin')->user();
        if ($user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:admins,username',
            'email'      => 'required|email|unique:admins,email',
            'role'       => 'required|in:admin,superadmin',
            'password'   => 'required|confirmed|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('superadmin.account.index')->with('success', 'Admin account created successfully.');
    }

    public function show($id)
    {
        $user = auth('admin')->user();
        $admin = Admin::findOrFail($id);

        if ($user->role !== 'superadmin' && $user->id != $admin->id) {
            abort(403, 'Unauthorized');
        }

        $view = $user->role === 'superadmin' ? 'superadmin.account.show' : 'admin.account.show';
        return view($view, compact('admin'));
    }

    public function edit($id)
    {
        $user = auth('admin')->user();
        $admin = Admin::findOrFail($id);

        if ($user->role !== 'superadmin' && $user->id != $admin->id) {
            abort(403, 'Unauthorized');
        }

        $view = $user->role === 'superadmin' ? 'superadmin.account.edit' : 'admin.account.edit';
        return view($view, compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $user = auth('admin')->user();
        $admin = Admin::findOrFail($id);

        if ($user->role !== 'superadmin' && $user->id != $admin->id) {
            abort(403, 'Unauthorized');
        }

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:admins,username,' . $id,
            'email'      => 'required|email|unique:admins,email,' . $id,
        ];

        if ($user->role === 'superadmin') {
            $rules['role'] = 'required|in:admin,superadmin';
        }

        $request->validate($rules);

        $admin->first_name = $request->first_name;
        $admin->last_name  = $request->last_name;
        $admin->username   = $request->username;
        $admin->email      = $request->email;
        if ($user->role === 'superadmin') {
            $admin->role = $request->role;
        }
        $admin->save();

        $route = $user->role === 'superadmin' ? 'superadmin.account.index' : 'admin.account.index';
        return redirect()->route($route)->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $user = auth('admin')->user();
        if ($user->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('superadmin.account.index')->with('success', 'Admin archived successfully.');
    }
}
