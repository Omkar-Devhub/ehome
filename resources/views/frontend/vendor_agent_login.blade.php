@extends('frontend.layout.master')
@section('title', 'Sevice Provider Login')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 80vh;">
        <div style="width: 100%; max-width: 400px;">
            @if (session('message'))
                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="loginTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="agent-tab" data-bs-toggle="tab" data-bs-target="#agent"
                        type="button" role="tab" aria-controls="agent" aria-selected="true">Estate Agent</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="vendor-tab" data-bs-toggle="tab" data-bs-target="#vendor" type="button"
                        role="tab" aria-controls="vendor" aria-selected="false">Service Provider</button>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content" id="loginTabsContent">
                <!-- Agent Login -->
                <div class="tab-pane fade show active" id="agent" role="tabpanel" aria-labelledby="agent-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="mt-2">Welcome back!</h2>
                            <p class="text-muted">Please login to your account to continue</p>
                            <form action="{{ route('agent.login.process') }}" method="POST">
                                @csrf
                                <!-- Username Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text"
                                        class="form-control shadow-none @error('email') is-invalid @enderror" name="email"
                                        id="email" value="{{ old('email') }}" placeholder="Enter Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password"
                                        class="form-control shadow-none @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Remember Me and Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check custom-checkbox shadow-none">
                                        <input type="checkbox" class="form-check-input shadow-none" id="rememberMe">
                                        <label class="form-check-label text-muted" for="rememberMe">Remember Me</label>
                                    </div>
                                    <div>
                                        <a href="{{ route('forgot.password') }}"
                                            class="text-decoration-none text-primary">Forgot
                                            Password?</a>
                                    </div>
                                </div>
                                <!-- Login Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary shadow-none text-light">Login as
                                        Agent</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Vendor Login -->
                <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="vendor-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="mt-2">Welcome back!</h2>
                            <p class="text-muted">Please login to your account to continue</p>
                            <form action="{{ route('vendor.login.process') }}" method="POST">
                                @csrf
                                <!-- Username Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text"
                                        class="form-control shadow-none @error('email') is-invalid @enderror" name="email"
                                        id="email" value="{{ old('email') }}" placeholder="Enter Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password"
                                        class="form-control shadow-none @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Remember Me and Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check custom-checkbox shadow-none">
                                        <input type="checkbox" class="form-check-input shadow-none" id="rememberMe">
                                        <label class="form-check-label text-muted" for="rememberMe">Remember Me</label>
                                    </div>
                                    <div>
                                        <a href="{{ route('vendor.forgot.password') }}"
                                            class="text-decoration-none text-primary">Forgot
                                            Password?</a>
                                    </div>
                                </div>
                                <!-- Login Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary shadow-none text-light">Login as
                                        Service Provider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
