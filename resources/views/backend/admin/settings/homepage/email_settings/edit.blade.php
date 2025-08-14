@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Email Settings</h1>
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
                    <form action="{{ route('admin.settings.email-settings.update') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="smtp_host">SMTP Host</label>
                                        <input type="text" name="smtp_host" id="smtp_host"
                                            value="{{ $email_settings->smtp_host }}"
                                            class="form-control @error('smtp_host')
                                                is-invalid
                                            @enderror"
                                            placeholder="SMTP Host">
                                        @error('smtp_host')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="smtp_port">SMTP Port</label>
                                        <input type="text" name="smtp_port" id="smtp_port"
                                            value="{{ $email_settings->smtp_port }}"
                                            class="form-control @error('smtp_port')
                                                is-invalid
                                            @enderror"
                                            placeholder="SMTP Port">
                                        @error('smtp_port')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="encryption">Encryption</label>
                                        <select name="encryption" id="encryption"
                                            class="form-control @error('encryption') is-invalid @enderror">
                                            <option value="">Select Encryption</option>
                                            <option value="tls"
                                                {{ $email_settings->encryption == 'tls' ? 'selected' : '' }}>TLS
                                            </option>
                                            <option value="ssl"
                                                {{ $email_settings->encryption == 'ssl' ? 'selected' : '' }}>SSL</option>
                                            <option value="starttls"
                                                {{ $email_settings->encryption == 'starttls' ? 'selected' : '' }}>STARTTLS
                                            </option>
                                        </select>
                                        @error('encryption')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="smtp_username">SMTP Username</label>
                                        <input type="text" name="smtp_username" id="smtp_username"
                                            value="{{ $email_settings->smtp_username }}"
                                            class="form-control @error('smtp_username')
                                                is-invalid
                                            @enderror"
                                            placeholder="SMTP Username">
                                        @error('smtp_username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="smtp_password">SMTP Password</label>
                                        <input type="password" name="smtp_password" id="smtp_password"
                                            value="{{ $email_settings->smtp_password }}"
                                            class="form-control @error('smtp_password')
                                                is-invalid
                                            @enderror"
                                            placeholder="SMTP Password">
                                        @error('smtp_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="from_email">From Email</label>
                                        <input type="text" name="from_email" id="from_email"
                                            value="{{ $email_settings->from_email }}"
                                            class="form-control @error('from_email')
                                                is-invalid
                                            @enderror"
                                            placeholder="From Email">
                                        @error('from_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="from_name">From Name</label>
                                        <input type="text" name="from_name" id="from_name"
                                            value="{{ $email_settings->from_name }}"
                                            class="form-control @error('from_name')
                                                is-invalid
                                            @enderror"
                                            placeholder="From Name">
                                        @error('from_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="status"
                                                name="status" {{ $email_settings->status == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status">Status</label>
                                        </div>
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
