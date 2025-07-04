@extends('layouts.superadmin')

@section('content')
<div class="container mt-5" style="max-width: 800px;">
    <h3 class="text-center mb-4">Edit Farmer</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.farmers.update', $farmer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required value="{{ old('first_name', $farmer->first_name) }}">
            </div>
            <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $farmer->middle_name) }}">
            </div>
            <div class="col-md-4">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required value="{{ old('last_name', $farmer->last_name) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
               <label>Suffix</label>
                <select name="suffix" class="form-control">
                    <option value="" disabled selected>Select Suffix</option>
                    <option value="Jr." {{ old('suffix') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                    <option value="Sr." {{ old('suffix') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                    <option value="II" {{ old('suffix') == 'II' ? 'selected' : '' }}>II</option>
                    <option value="III" {{ old('suffix') == 'III' ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ old('suffix') == 'IV' ? 'selected' : '' }}>IV</option>
                    <option value="V" {{ old('suffix') == 'V' ? 'selected' : '' }}>V</option>
                    <option value="None" {{ old('suffix') == 'None' ? 'selected' : '' }}>None</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Sex</label>
                <select name="gender" class="form-control" required>
                    <option disabled>Select Sex</option>
                    <option value="Male" {{ old('gender', $farmer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $farmer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>RSBSA Reference No.</label>
                <input type="text" name="rsbsa_ref_no" class="form-control" value="{{ old('rsbsa_ref_no', $farmer->rsbsa_ref_no) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>ID Name</label>
                <input type="text" name="id_name" class="form-control" value="{{ old('id_name', $farmer->id_name) }}">
            </div>
            <div class="col-md-6">
                <label>ID Number</label>
                <input type="text" name="id_number" class="form-control" value="{{ old('id_number', $farmer->id_number) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Total Farm Area (Hectares)</label>
            <input type="number" name="total_farm_area" class="form-control" step="0.01" min="0" value="{{ old('total_farm_area', $farmer->total_farm_area) }}">
        </div>

        <!-- Address -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Permanent Address 1</label>
                <input type="text" name="perm_address_street" class="form-control" value="{{ old('perm_address_street', $farmer->perm_address_street) }}">
            </div>
            <div class="col-md-6">
                <label>Permanent Address 2</label>
                <input type="text" name="perm_address_line2" class="form-control" value="{{ old('perm_address_line2', $farmer->perm_address_line2) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Barangay</label>
                <select name="perm_address_barangay" class="form-control" required>
                    <option disabled>Select Barangay</option>
                    @foreach([
                        'Anulid', 'Atainan', 'Bersamin', 'Canarvacanan', 'Caranglaan',
                        'Curareng', 'Gualsic', 'Kasikis', 'Laoac', 'Macayo',
                        'Pindangan Centro', 'Pindangan East', 'Pindangan West',
                        'Poblacion East', 'Poblacion West', 'San Juan', 'San Nicolas',
                        'San Pedro Apartado', 'San Pedro Ili', 'San Vicente', 'Vacante'
                    ] as $barangay)
                        <option value="{{ $barangay }}" {{ old('perm_address_barangay', $farmer->perm_address_barangay) == $barangay ? 'selected' : '' }}>{{ $barangay }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>City</label>
                <input type="text" name="perm_city" class="form-control" value="{{ old('perm_city', $farmer->perm_city ?? 'Alcala') }}" readonly>
            </div>
            <div class="col-md-3">
                <label>Province</label>
                <input type="text" name="perm_province" class="form-control" value="{{ old('perm_province', $farmer->perm_province ?? 'Pangasinan') }}" readonly>
            </div>
        </div>

        <!-- Personal Details -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Religion</label>
                <input type="text" name="religion" class="form-control" value="{{ old('religion', $farmer->religion) }}">
            </div>
            <div class="col-md-4">
                <label>Civil Status</label>
                <select name="civil_status" class="form-control">
                    @foreach(['Single', 'Married', 'Widowed', 'Separated', 'Divorced'] as $status)
                        <option value="{{ $status }}" {{ old('civil_status', $farmer->civil_status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Name of Spouse</label>
                <input type="text" name="name_of_spouse" class="form-control" value="{{ old('name_of_spouse', $farmer->name_of_spouse) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Highest Formal Education</label>
           <select name="highest_formal_education" class="form-control" required>
                    <option disabled selected>Select Education Level</option>
                    @foreach([
                        'No Formal Education', 'Elementary Level', 'Elementary Graduate',
                        'High School Level', 'High School Graduate', 'Vocational',
                        'College Level', 'College Graduate', 'Postgraduate'
                    ] as $education)
                        <option value="{{ $education }}" {{ old('highest_formal_education') == $education ? 'selected' : '' }}>
                            {{ $education }}
                        </option>
                    @endforeach
                </select>
        </div>

        <!-- Contact and Status -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label>Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" maxlength="11" pattern="09\d{9}" value="{{ old('mobile_number', $farmer->mobile_number) }}">
            </div>
            <div class="col-md-6">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Active" {{ old('status', $farmer->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $farmer->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update Farmer</button>
        </div>
    </form>
</div>
@endsection
