@extends('frontend.layout.master')
@section('title', 'Profile')
@section('content')
    <div class="container my-5">
        <div style="width: 100%; max-width: 400px;">
            @if (session('message'))
                <x-bs5-toast type="{{ session('type') }}" message="{{ session('message') }}" />
            @endif
        </div>
        <div class="mt-2" style="min-height: 600px;max-width: 600px;margin: 0 auto;">
            <div>
                <ul class="nav nav-underline nav-fill" role="tablist">
                    <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab"
                            href="#tab-1" aria-selected="false" tabindex="-1">Profile</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab"
                            href="#tab-2" aria-selected="true">Password &amp; Security</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab"
                            href="#tab-3" aria-selected="false" tabindex="-1">Account Control</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="tab-1">
                        <div class="mt-3">
                            <div>
                                <img class="img-thumbnail img-fluid border rounded border-2 border-primary"
                                    id="preview_profile_picture"
                                    src="@if (Auth::user()->photo) {{ asset('uploads/profile_images/' . Auth::user()->photo) }} @else {{ asset('uploads/placeholder.png') }} @endif"
                                    width="100px" height="100px">
                            </div>
                        </div>
                        <form class="my-3" action="{{ route('user.profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3"><label class="form-label">Update Profile Picture</label>
                                <input class="shadow-none form-control" type="file" accept="image/*"
                                    name="profile_picture" id="profile_picture">
                            </div>
                            <div class="mb-3"><label class="form-label">Name</label><input
                                    class="shadow-none form-control" type="text" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3"><label class="form-label">Email</label><input
                                    class="shadow-none form-control" type="text" name="email"
                                    value="{{ Auth::user()->email }}" readonly></div>
                            <div class="mb-3"><label class="form-label">Phone</label><input
                                    class="shadow-none form-control" type="text" name="phone"
                                    value="{{ Auth::user()->phone }}"></div>
                            <div class="mb-3"><label class="form-label">Address</label><input
                                    class="shadow-none form-control" type="text" name="address"
                                    value="{{ Auth::user()->address }}">
                            </div>
                            <div class="mb-3"><button class="btn btn-primary link-light" type="submit">Save
                                    Changes</button></div>
                        </form>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-2">
                        <form class="my-3" action="{{ route('user.change.password') }}" method="POST">
                            @csrf
                            <div class="mb-3"><label class="form-label">Current password</label><input
                                    class="shadow-none form-control @error('current_password') is-invalid @enderror"
                                    type="password" name="current_password" placeholder="Enter Current Password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3"><label class="form-label">New password</label><input
                                    class="shadow-none form-control @error('new_password') is-invalid @enderror"
                                    type="password" name="new_password" placeholder="Enter New Password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm passwrod</label>
                                <input class="shadow-none form-control @error('confirm_password') is-invalid @enderror"
                                    type="password" name="confirm_password" placeholder="Enter Confirm Password">
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3"><button class="btn btn-primary link-light" type="submit">Save
                                    Changes</button></div>
                        </form>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-3">
                        <form class="my-3">
                            <div class="mb-3">
                                <h5>Your ID</h5>
                                <div class="mb-3">
                                    <p class="mb-0">This is your id with eirehome&nbsp;</p>
                                    <input class="shadow-none form-control mt-2" type="text"
                                        value="{{ 'Eire-' . Auth::user()->id }}" readonly="" style="width: 30%;"
                                        readonly>
                                </div>
                                <hr>
                                <h5>Delete your account</h5>
                                <p>permanently remove your account and all it's content for eirehome platform. this action
                                    is not reversable, so please continue with caution.&nbsp;</p><button
                                    class="btn btn-danger link-light" type="button">Request Account Deletion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        document
            .getElementById("profile_picture")
            .addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("preview_profile_picture").src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
@endsection
@endsection
