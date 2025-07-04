<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAdminController extends Controller
{
    /**
     * Show the admin registration form.
     */
    public function createAdmin()
    {
        return view('superadmin.users.create'); // Match the proper Blade path if applicable
    }

    /**
     * Store a newly created admin.
     */
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
            'status'   => 'Active',
        ]);

        return redirect()->route('superadmin.users.create')->with('success', 'Admin registered successfully.');
    }

    /**
     * Display a listing of the admins.
     */
    public function index()
    {
        $users = Admin::select('id', 'name', 'first_name', 'last_name', 'mobile_number as phone', 'role', 'status')->get();

        // If name is empty, combine first and last name
        $users->transform(function ($user) {
            if (empty($user->name)) {
                $user->name = trim("{$user->first_name} {$user->last_name}");
            }
            return $user;
        });

        return view('superadmin.users.index', compact('users')); // Update path if needed
    }
}
