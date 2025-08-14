@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Contact Settings</h1>
                    <a href="{{ route('admin.settings') }}" class="btn btn-dark">Back</a>
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
                    <form action="{{ route('admin.settings.contact-settings.update') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address"
                                            value="{{ $contact_settings->address }}"
                                            class="form-control @error('address')
                                                is-invalid
                                            @enderror"
                                            placeholder="Address">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="phone">Phone No</label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ $contact_settings->phone }}"
                                            class="form-control @error('phone')
                                                is-invalid
                                            @enderror"
                                            placeholder="Phone No">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email"
                                            value="{{ $contact_settings->email }}"
                                            class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                                            placeholder="Email Address">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="approver_email">Approver Email</label>
                                        <input type="text" name="approver_email" id="approver_email"
                                            value="{{ $contact_settings->approver_email }}"
                                            class="form-control @error('approver_email')
                                                is-invalid
                                            @enderror"
                                            placeholder="Email Address">
                                        @error('approver_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="sales_email">Sales Email</label>
                                        <input type="text" name="sales_email" id="sales_email"
                                            value="{{ $contact_settings->sales_email }}"
                                            class="form-control @error('sales_email')
                                                is-invalid
                                            @enderror"
                                            placeholder="Email Address">
                                        @error('sales_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
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
@endsection
