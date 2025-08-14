@extends('frontend.layout.master')
@section('title', 'Onboarding Request')
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center py-3" style="min-height: 80lvh;">
        <div style="width: 100%; max-width: 400px;">
            @if (session('message'))
                <x-alert type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif
        </div>
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <!-- Form Header with Icon -->
            <div class="mb-1">
                <h2 class="mt-2">Request Registration</h2>
                <p class="text-muted">Fill the form to request agent or vendor access</p>
            </div>
            <form action="{{ route('vendor.registration.request.submit') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <div class="form-check form-check-inline custom-radio">
                        <input class="form-check-input shadow-none" type="radio" name="reg_type" id="agent"
                            value="agent" checked>
                        <label class="form-check-label" for="agent">Estate Agent</label>
                    </div>
                    <div class="form-check form-check-inline custom-radio">
                        <input class="form-check-input shadow-none" type="radio" name="reg_type" id="vendor"
                            value="vendor">
                        <label class="form-check-label" for="vendor">Service Provider</label>
                    </div>
                </div>
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label required-field">Full Name</label>
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
                    <input type="email" class="form-control shadow-none @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label required-field">Phone</label>
                    <input type="text" class="form-control shadow-none @error('phone') is-invalid @enderror"
                        id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label for="address" class="form-label required-field">Address</label>
                    <textarea class="form-control shadow-none @error('address') is-invalid @enderror" id="address" name="address"
                        placeholder="Enter your address">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check custom-checkbox mb-3">
                    <input class="form-check-input shadow-none @error('terms') is-invalid @enderror" type="checkbox"
                        value="1" id="flexCheckDefault" name="terms" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                        I agree to the <a href="{{ route('front.page', 'terms-and-conditions') }}"
                            class="text-primary text-decoration-none">Terms of Use</a> and
                        <a href="{{ route('front.page', 'privacy-policy') }}"
                            class="text-primary text-decoration-none">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary text-light shadow-none">Request Callback for
                        Registration</button>
                </div>
            </form>
            <!-- Divider -->
            <div class="position-relative text-center mb-3">
                <hr class="text-muted">
                <span class="position-absolute top-50 translate-middle bg-white px-2 text-muted">OR</span>
            </div>

            <!-- Already Have an Account? Login Link -->
            <div class="text-right">
                <p class="mb-0 text-muted">Already have an account? <a href="{{ route('login') }}"
                        class="text-decoration-none text-primary">Login</a></p>
            </div>

        </div>
    </div>
@endsection
