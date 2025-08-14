@extends('frontend.layout.master')
@section('title', 'Register')
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 80lvh;">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <!-- Form Header with Icon -->
            <div class="mb-2">
                <h2 class="mt-2">Register</h2>
                <p class="text-muted">Create your account to get started.</p>
            </div>
            <form action="{{ route('registration.process') }}" method="POST">
                @csrf
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label required-field">Name</label>
                    <input type="text"
                        class="form-control shadow-none @error('name')
                    is-invalid
                @enderror"
                        id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label required-field">Email</label>
                    <input type="email"
                        class="form-control shadow-none @error('email')
                    is-invalid
                @enderror"
                        id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label required-field">Password</label>
                    <input type="password"
                        class="form-control shadow-none @error('password')
                    is-invalid
                @enderror"
                        id="password" name="password" placeholder="Enter password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label required-field">Confirm Password</label>
                    <input type="password"
                        class="form-control shadow-none @error('confirm_password')
                    is-invalid
                @enderror"
                        name="confirm_password" id="confirmPassword" placeholder="Confirm password">
                    @error('confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input shadow-none @error('terms') is-invalid @enderror" type="checkbox"
                        value="1" id="flexCheckDefault" name="terms">
                    <label class="form-check-label" for="flexCheckDefault">
                        I agree to the <a href="{{ route('front.page', 'terms-and-conditions') }}"
                            class="text-primary text-decoration-none">Terms of Use</a> and
                        <a href="{{ route('front.page', 'privacy-policy') }}"
                            class="text-primary text-decoration-none">Privacy Policy</a>
                    </label>
                </div>
                <!-- Register Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary text-light shadow-none">Register</button>
                </div>
            </form>
            <!-- Divider -->
            <div class="position-relative text-center mb-3">
                <hr class="text-muted">
                <span class="position-absolute top-50 translate-middle bg-white px-2 text-muted">OR</span>
            </div>

            <!-- Already Have an Account? Login Link -->
            <div class="text-start">
                <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}"
                        class="text-decoration-none text-primary">Login</a></p>
                <p class="mb-0 text-muted">Estate Agent/Service Provider? <a
                        href="{{ route('vendor.registration.request') }}"
                        class="text-decoration-none text-primary">Register</a></p>
            </div>

        </div>
    </div>
@endsection
