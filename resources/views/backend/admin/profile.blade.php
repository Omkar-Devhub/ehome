@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Edit Profile</h1>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Back</a>
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
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="mb-3">
                                        <div class="mb-4 d-flex justify-content-center">
                                            <img id="profile_image" class="img-fluid img-thumbnail"
                                                src="{{ asset('uploads/profile_images/' . Auth::guard('admin')->user()->photo) }}"
                                                alt="Profile Picture" style="width: 280px; height: 280px" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="profile_image" class="form-control border-0"
                                                accept="image/*" id="input_profile_image" />
                                            @error('profile_image')
                                                <div class="invalid-feedback">{{ $message }}></div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ Auth::guard('admin')->user()->name }}"
                                            class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                            placeholder="Name">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email"
                                            value="{{ Auth::guard('admin')->user()->email }}"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ Auth::guard('admin')->user()->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Phone No.">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
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
        document
            .getElementById("input_profile_image")
            .addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("profile_image").src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
@endsection
@endsection
