@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Edit {{ $agent->company_name }}</h1>
                    <a href="{{ route('admin.agents') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            {{-- Toast Message --}}
            @if (session('toast'))
                @if (session('toast.type') == 'success')
                    <x-toast :message="session('toast.message')" :type="session('toast.type', 'success')" />
                @else
                    <x-toast :message="session('toast.message')" :type="session('toast.type', 'danger')" />
                @endif
            @endif
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <form action="{{ route('admin.agents.update', $agent->id) }}') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Company Logo</label>
                                        <br>
                                        <img src="{{ asset('uploads/agent/company_logos/' . $agent->company_logo) }}"
                                            class="img-fluid" alt="Company Logo" style="width: 120px; ">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Profile Picture</label>
                                        <br>
                                        <img src="{{ asset('uploads/agent/profile_images/' . $agent->profile_picture) }}"
                                            class="img-fluid" alt="Company Logo" style="width: 120px;">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Company Name</label>
                                        <input type="text" name="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            placeholder="Company Name"
                                            value="{{ old('company_name', $agent->company_name) }}">
                                        @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Business Type</label>
                                        <input type="text" name="business_type"
                                            class="form-control @error('business_type') is-invalid @enderror"
                                            placeholder="Business Type"
                                            value="{{ old('business_type', $agent->business_type) }}">
                                        @error('business_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Company Registration Number</label>
                                        <input type="text" name="company_registration_number"
                                            class="form-control @error('company_registration_number') is-invalid @enderror"
                                            placeholder="Company Registration Number"
                                            value="{{ old('company_registration_number', $agent->company_registration_number) }}">
                                        @error('company_registration_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">PSRA License Number</label>
                                        <input type="text" name="psra_license_number"
                                            class="form-control @error('psra_license_number') is-invalid @enderror"
                                            placeholder="PSA License Number"
                                            value="{{ old('psra_license_number', $agent->psra_license_number) }}">
                                        @error('psra_license_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">PSRA License Expiry</label>
                                        <input type="text" name="license_expiry_date"
                                            class="form-control @error('license_expiry_date') is-invalid @enderror"
                                            placeholder="PSA License Expiry"
                                            value="{{ old('license_expiry_date', \Carbon\Carbon::parse($agent->license_expiry_date)->format('d/m/Y')) }}">
                                        @error('license_expiry_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Authorized Person</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="User Name"
                                            value="{{ old('name', $agent->full_name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror @if ($agent->email_verified == 1) is-valid @endif"
                                            placeholder="Email" value="{{ old('email', $agent->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" placeholder="Phone"
                                            value="{{ old('phone', $agent->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="vat_registration_number">VAT Registration Number</label>
                                        <input type="text" name="vat_registration_number"
                                            class="form-control @error('vat_registration_number') is-invalid @enderror"
                                            placeholder="VAT Registration Number"
                                            value="{{ old('vat_registration_number', $agent->vat_registration_number) }}">
                                        @error('vat_registration_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="business_phone">Business Phone</label>
                                        <input type="text" name="business_phone"
                                            class="form-control @error('business_phone') is-invalid @enderror"
                                            placeholder="Business Phone"
                                            value="{{ old('business_phone', $agent->business_phone) }}">
                                        @error('business_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="business_email">Business Email</label>
                                        <input type="text" name="business_email"
                                            class="form-control @error('business_email') is-invalid @enderror"
                                            placeholder="Business Email"
                                            value="{{ old('business_email', $agent->business_email) }}">
                                        @error('business_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="role">Role In Business</label>
                                        <input type="text" name="role"
                                            class="form-control @error('role') is-invalid @enderror"
                                            placeholder="Role In Business"
                                            value="{{ old('role', ucfirst($agent->role)) }}">
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="5">{{ $agent->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10">
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" placeholder="Address"
                                            value="{{ $agent->office_address }}, {{ Str::ucfirst($agent->area->name) }}, {{ Str::ucfirst($agent->county->name) }}, {{ $agent->eircode }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" id="status-select">
                                                <option value="1" {{ $agent->status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ $agent->status == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                                <option value="2" {{ $agent->status == 2 ? 'selected' : '' }}>
                                                    Suspended
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="reason-container" style="display: none;">
                                    <div class="mb-3">
                                        <label for="reason">Reason</label>
                                        <textarea name="reason" class="form-control" id="" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

@section('custom-js')
    <script>
        const statusSelect = document.getElementById('status-select');
        const reasonContainer = document.getElementById('reason-container');

        function toggleReasonField() {
            const status = parseInt(statusSelect.value);
            if (status === 0 || status === 2) {
                reasonContainer.style.display = 'block';
            } else {
                reasonContainer.style.display = 'none';
            }
        }

        // Trigger on load
        toggleReasonField();

        // Trigger on change
        statusSelect.addEventListener('change', toggleReasonField);
    </script>
@endsection
@endsection
