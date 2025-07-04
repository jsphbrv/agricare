@extends('layouts.superadmin')

@section('content')
<div class="container mt-5" style="max-width: 800px;">
    <h3 class="text-center mb-4">Register Farmer</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.farmers.store') }}" method="POST">
        @csrf

        <!-- Basic Information -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required value="{{ old('first_name') }}">
            </div>
            <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
            </div>
            <div class="col-md-4">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required value="{{ old('last_name') }}">
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
                    <option disabled selected>Select Sex</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>RSBSA Reference No.</label>
                <input type="number" name="rsbsa_ref_no" class="form-control" value="{{ old('rsbsa_ref_no') }}" min="0" step="1" pattern="\d*">
            </div>
        </div>

        <!-- Valid ID -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>ID Type</label>
                <select name="id_name" class="form-control">
                    <option disabled selected>Select Valid ID</option>
                    @foreach([
                        'PhilHealth ID', 'SSS ID', 'UMID', 'Passport', 'Driver’s License',
                        'PRC ID', 'TIN ID', 'National ID', 'Postal ID', 'Voter’s ID',
                        'Senior Citizen ID', 'PWD ID', 'Barangay ID', 'Student ID'
                    ] as $id)
                        <option value="{{ $id }}" {{ old('id_name') == $id ? 'selected' : '' }}>{{ $id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>ID Number</label>
                <input type="text" name="id_number" class="form-control" value="{{ old('id_number') }}">
            </div>
        </div>

        <!-- Farm Area -->
        <div class="mb-3">
            <label>Total Farm Area (Hectares)</label>
            <input type="number" name="total_farm_area" class="form-control" step="0.01" min="0" value="{{ old('total_farm_area') }}">
        </div>

        <!-- Address -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Permanent Address 1</label>
                <input type="text" name="perm_address_street" class="form-control" value="{{ old('perm_address_street') }}">
            </div>
            <div class="col-md-6">
                <label>Permanent Address 2</label>
                <input type="text" name="perm_address_line2" class="form-control" value="{{ old('perm_address_line2') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Barangay</label>
                <select name="perm_address_barangay" class="form-control" required>
                    <option disabled selected>Select Barangay</option>
                    @foreach([
                        'Anulid', 'Atainan', 'Bersamin', 'Canarvacanan', 'Caranglaan',
                        'Curareng', 'Gualsic', 'Kasikis', 'Laoac', 'Macayo',
                        'Pindangan Centro', 'Pindangan East', 'Pindangan West',
                        'Poblacion East', 'Poblacion West', 'San Juan', 'San Nicolas',
                        'San Pedro Apartado', 'San Pedro Ili', 'San Vicente', 'Vacante'
                    ] as $barangay)
                        <option value="{{ $barangay }}" {{ old('perm_address_barangay') == $barangay ? 'selected' : '' }}>{{ $barangay }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>City</label>
                <input type="text" name="perm_city" class="form-control" value="Alcala" readonly>
            </div>
            <div class="col-md-3">
                <label>Province</label>
                <input type="text" name="perm_province" class="form-control" value="Pangasinan" readonly>
            </div>
        </div>

        <!-- Personal Info -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Birthdate</label>
                <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
            </div>
            <div class="col-md-4">
                <label>Birthplace</label>
                <input type="text" name="birthplace" class="form-control" value="{{ old('birthplace') }}">
            </div>
            <div class="col-md-4">
                <label>Religion</label>
                <select name="religion" class="form-control">
                    <option disabled selected>Select Religion</option>
                    @foreach(['Roman Catholic', 'Iglesia ni Cristo', 'Protestant', 'Islam', 'Buddhist', 'Hindu', 'Born Again', 'Other'] as $religion)
                        <option value="{{ $religion }}" {{ old('religion') == $religion ? 'selected' : '' }}>{{ $religion }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Civil Status</label>
                <select name="civil_status" class="form-control" required>
                    <option disabled selected>Select Civil Status</option>
                    @foreach(['Single', 'Married', 'Widowed', 'Separated'] as $status)
                        <option value="{{ $status }}" {{ old('civil_status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Name of Spouse</label>
                <input type="text" name="name_of_spouse" class="form-control" value="{{ old('name_of_spouse') }}">
            </div>
            <div class="col-md-4">
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
        </div>

        <!-- Additional Info -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Nationality</label>
                <select name="nationality" class="form-control" required>
                    <option disabled selected>Select Nationality</option>
                    @foreach(['Filipino', 'American', 'Chinese', 'Japanese', 'Korean', 'Other'] as $nation)
                        <option value="{{ $nation }}" {{ old('nationality') == $nation ? 'selected' : '' }}>{{ $nation }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Profession</label>
                <input type="text" name="profession" class="form-control" value="{{ old('profession') }}">
            </div>
            <div class="col-md-4">
                <label>Source of Funds</label>
                <input type="text" name="source_of_funds" class="form-control" value="{{ old('source_of_funds') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Mother's Maiden Name</label>
            <input type="text" name="mothers_maiden_name" class="form-control" value="{{ old('mothers_maiden_name') }}">
        </div>

        <div class="mb-3">
            <label>Emboss Name</label>
            <input type="text" name="emboss_name" class="form-control" value="{{ old('emboss_name') }}">
        </div>

        <!-- Contact -->
        <div class="mb-3">
            <label>Mobile Number</label>
            <input type="text" name="mobile_number" class="form-control" pattern="09\d{9}" maxlength="11"
                   title="Must be a valid 11-digit number starting with 09"
                   value="{{ old('mobile_number') }}" required>
        </div>

        <!-- Password Fields -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label>Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" id="password" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">Show</button>
                </div>
            </div>
            <div class="col-md-6">
                <label>Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">Show</button>
                    <button class="btn btn-outline-primary ms-2" type="button" onclick="generatePassword()">Generate</button>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-success">Register</button>
        </div>
    </form>
</div>

<!-- JS -->
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function generatePassword() {
        const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let password = "";
        for (let i = 0; i < 10; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        document.getElementById("password").value = password;
        document.getElementById("password_confirmation").value = password;
    }

    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.opacity = 0;
            alert.remove();
        }
    }, 4000);
</script>
@endsection
