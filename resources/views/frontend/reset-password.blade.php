@extends('frontend.layout.master')
@section('title', 'Reset Password')
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 60vh;">
        <div style="width: 100%; max-width: 400px;">
            @if (session('message'))
                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif
        </div>
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
            <!-- Form Header with Icon -->
            <div class="mb-2">
                <h2 class="mt-2">Reset New Password</h2>
                <p class="text-muted">Create a new password for your account.</p>
            </div>
            <form action="{{ route('password.reset.update', ['token' => $user->token, 'email' => $user->email]) }}"
                method="POST">
                @csrf
                <!-- New Password Field -->
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control shadow-none @error('password') is-invalid @enderror"
                        name="password" id="newPassword" placeholder="Enter new password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm New Password Field -->
                <div class="mb-4">
                    <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control shadow-none @error('confirm_password') is-invalid @enderror"
                        name="confirm_password" id="confirmNewPassword" placeholder="Confirm new password">
                    @error('confirm_password')
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
                <p class="mb-0 text-muted">Remember your password? <a href="{{ route('login') }}"
                        class="text-decoration-none text-primary">Login</a></p>
            </div>
        </div>
    </div>
@endsection
