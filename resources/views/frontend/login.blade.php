@extends('frontend.layout.master')
@section('title', 'Login')
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 80vh;">
        <div style="width: 100%; max-width: 400px;">
            @if (session('message'))
                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif
        </div>
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <!-- Form Header with Icon -->
            <div class="mb-2">
                <h2 class="mt-2">Welcome back!</h2>
                <p class="text-muted">Login to your account</p>
            </div>

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <!-- Username Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text"
                        class="form-control shadow-none @error('email')
                    is-invalid
                @enderror"
                        name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                        class="form-control shadow-none @error('password')
                    is-invalid
                @enderror"
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
                        <a href="{{ route('forgot.password') }}" class="text-decoration-none text-primary">Forgot
                            Password?</a>
                    </div>
                </div>
                <!-- Login Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary shadow-none text-light">Login</button>
                </div>
            </form>
            <!-- Divider -->
            <div class="position-relative text-center mb-3">
                <hr class="text-muted">
                <span class="position-absolute top-50 translate-middle bg-white px-2 text-muted">OR</span>
            </div>

            <!-- Don't Have an Account? Register Link -->
            <div>
                <p class="mb-0 text-muted">Don't have an account? <a href="{{ route('registration') }}"
                        class="text-decoration-none text-primary">Register</a></p>
            </div>
            <div>
                <p class="mb-0 text-muted">Estate Agent/Service Provider? <a href="{{ route('vendor.login') }}"
                        class="text-decoration-none text-primary">Login</a></p>
            </div>
        </div>
    </div>
@endsection
