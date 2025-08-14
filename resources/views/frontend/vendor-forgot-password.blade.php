@extends('frontend.layout.master')
@section('title', 'Service Provider Forgot Password')
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
        <div style="width: 100%; max-width: 400px;">
            @if (session('message'))
                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif
        </div>
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <!-- Form Header with Icon -->
            <div class="mb-2">
                <h2 class="mt-2">Forgot Password</h2>
                <p class="text-muted">Enter your email to receive reset link.</p>
            </div>
            <form action="{{ route('password.reset.request') }}" method="POST">
                @csrf
                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email"
                        class="form-control shadow-none @error('email')
                    is-invalid
                @enderror"
                        name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary text-light shadow-none">Reset Password</button>
                </div>
            </form>

            <!-- Back to Login Link -->
            <div class="text-center">
                <p class="mb-0 text-muted">Remember your password?
                    <a href="{{ route('vendor.login') }}" class="text-decoration-none text-primary">Service Provider
                        Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection
