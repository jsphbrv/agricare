<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class FarmerUserController extends Controller
{
    private $barangays = [
        'Anulid', 'Atainan', 'Bersamin', 'Canarvacanan', 'Caranglaan',
        'Curareng', 'Gualsic', 'Kasikis', 'Laoac', 'Macayo',
        'Pindangan Centro', 'Pindangan East', 'Pindangan West',
        'Poblacion East', 'Poblacion West', 'San Juan', 'San Nicolas',
        'San Pedro Apartado', 'San Pedro Ili', 'San Vicente', 'Vacante'
    ];

    private function resolveView($view)
    {
        return match (Auth::user()->role) {
            'admin' => "admin.farmers.$view",
            'superadmin' => "superadmin.farmers.$view",
            default => abort(403),
        };
    }

    public function index(Request $request)
    {
        $query = User::where('role', 'farmer')
                     ->whereIn('status', ['Active', 'Inactive']);

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view($this->resolveView('index'), compact('users'));
    }

    public function create()
    {
        return view($this->resolveView('create'), ['barangays' => $this->barangays]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rsbsa_ref_no'               => 'nullable|string|max:50',
            'last_name'                  => 'required|string|max:50',
            'first_name'                 => 'required|string|max:50',
            'middle_name'               => 'nullable|string|max:50',
            'suffix'                    => 'nullable|string|max:10',
            'gender'                    => 'required|in:Male,Female',
            'perm_address_barangay'     => 'required|string|max:100',
            'perm_address_line2'        => 'nullable|string|max:100',
            'mobile_number'             => 'required|string|regex:/^09\d{9}$/|unique:users,mobile_number',
            'password'                  => 'required|confirmed|min:6',
            'total_farm_area'           => 'nullable|numeric|min:0|max:9999',
            'id_number'                 => 'nullable|string|max:50',
            'id_name'                   => 'nullable|string|max:100',
            'perm_address_street'      => 'nullable|string|max:100',
            'perm_city'                => 'nullable|string|max:100',
            'perm_province'            => 'nullable|string|max:100',
            'birthdate'                => 'nullable|date',
            'birthplace'               => 'nullable|string|max:100',
            'religion'                 => 'nullable|string|max:50',
            'civil_status'             => 'nullable|string|max:50',
            'name_of_spouse'           => 'nullable|string|max:100',
            'highest_formal_education' => 'nullable|string|max:100',
            'nationality'              => 'nullable|string|max:50',
            'profession'               => 'nullable|string|max:100',
            'source_of_funds'          => 'nullable|string|max:100',
            'mothers_maiden_name'      => 'nullable|string|max:100',
            'emboss_name'              => 'nullable|string|max:100',
        ]);

        try {
            $plainPassword = $request->password;
            $generatedEmail = strtolower($request->first_name . '.' . $request->last_name . '@agriare.local');

            $user = User::create([
                'rsbsa_ref_no'               => $request->rsbsa_ref_no,
                'last_name'                  => $request->last_name,
                'first_name'                 => $request->first_name,
                'middle_name'               => $request->middle_name,
                'suffix'                    => $request->suffix,
                'name'                      => $request->first_name . ' ' . $request->last_name,
                'gender'                    => $request->gender,
                'address'                   => $request->perm_address_barangay,
                'perm_address_barangay'    => $request->perm_address_barangay,
                'perm_address_line2'       => $request->perm_address_line2,
                'perm_address_street'      => $request->perm_address_street,
                'perm_city'                => $request->perm_city ?? 'Alcala',
                'perm_province'            => $request->perm_province ?? 'Pangasinan',
                'birthdate'                => $request->birthdate,
                'birthplace'               => $request->birthplace,
                'religion'                 => $request->religion,
                'civil_status'             => $request->civil_status,
                'name_of_spouse'           => $request->name_of_spouse,
                'highest_formal_education' => $request->highest_formal_education,
                'nationality'              => $request->nationality,
                'profession'               => $request->profession,
                'source_of_funds'          => $request->source_of_funds,
                'mothers_maiden_name'      => $request->mothers_maiden_name,
                'emboss_name'              => $request->emboss_name,
                'mobile_number'            => $request->mobile_number,
                'email'                    => $generatedEmail,
                'password'                 => Hash::make($plainPassword),
                'id_number'                => $request->id_number,
                'id_name'                  => $request->id_name,
                'total_farm_area'          => $request->total_farm_area,
                'role'                     => 'farmer',
                'status'                   => 'Active',
            ]);

            // SMS sending via Semaphore
            try {
                $message = "Welcome to AgriCare!\nEmail: {$generatedEmail}\nPassword: {$plainPassword}";
                $response = Http::asForm()->timeout(30)->post('https://api.semaphore.co/api/v4/messages', [
                    'apikey'     => env('SEMAPHORE_API_KEY'),
                    'number'     => $user->mobile_number,
                    'message'    => $message,
                    'sendername' => env('SEMAPHORE_SENDER', 'AgriCare'),
                ]);

                if (!$response->successful()) {
                    Log::error('Semaphore SMS failed: ' . $response->body());
                }
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                Log::error('Semaphore connection failed: ' . $e->getMessage());
            }

            return redirect()->route(Auth::user()->role . '.farmers.create')
                             ->with('success', 'Farmer registered successfully and credentials sent via SMS!');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['mobile_number' => 'The mobile number is already registered.']);
        }
    }

    public function edit($id)
    {
        $farmer = User::findOrFail($id);
        return view($this->resolveView('edit'), compact('farmer'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name'              => 'required|string|max:50',
            'last_name'               => 'required|string|max:50',
            'gender'                  => 'required|in:Male,Female',
            'perm_address_barangay'  => 'required|string|max:100',
            'mobile_number'          => 'required|string|regex:/^09\d{9}$/|unique:users,mobile_number,' . $user->id,
            'password'               => 'nullable|confirmed|min:6',
            'status'                 => 'required|in:Active,Inactive',
        ]);

        $user->update([
            'first_name'                => $request->first_name,
            'middle_name'               => $request->middle_name,
            'last_name'                 => $request->last_name,
            'suffix'                    => $request->suffix,
            'name'                      => $request->first_name . ' ' . $request->last_name,
            'gender'                    => $request->gender,
            'address'                   => $request->perm_address_barangay,
            'perm_address_barangay'    => $request->perm_address_barangay,
            'perm_address_line2'       => $request->perm_address_line2,
            'perm_address_street'      => $request->perm_address_street,
            'perm_city'                => $request->perm_city,
            'perm_province'            => $request->perm_province,
            'birthdate'                => $request->birthdate,
            'birthplace'               => $request->birthplace,
            'religion'                 => $request->religion,
            'civil_status'             => $request->civil_status,
            'name_of_spouse'           => $request->name_of_spouse,
            'highest_formal_education' => $request->highest_formal_education,
            'nationality'              => $request->nationality,
            'profession'               => $request->profession,
            'source_of_funds'          => $request->source_of_funds,
            'mothers_maiden_name'      => $request->mothers_maiden_name,
            'emboss_name'              => $request->emboss_name,
            'mobile_number'            => $request->mobile_number,
            'status'                   => $request->status,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route(Auth::user()->role . '.farmers.index')
                         ->with('success', 'Farmer updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'Archived';
        $user->save();

        return redirect()->route(Auth::user()->role . '.farmers.index')->with('success', 'Farmer archived successfully.');
    }

    public function archived()
    {
        $users = User::where('role', 'farmer')->where('status', 'Archived')->get();
        return view($this->resolveView('archived'), compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view($this->resolveView('show'), compact('user'));
    }
}
