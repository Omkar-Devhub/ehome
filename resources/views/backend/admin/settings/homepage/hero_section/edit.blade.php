@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Edit Hero Section</h1>
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
                    <form action="{{ route('admin.settings.hero-section.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <div class="mb-4 d-flex justify-content-center">
                                            <img id="hero_image" class="img-fluid img-thumbnail"
                                                src="{{ asset('uploads/frontend_images/' . $hero_section->image) }}"
                                                alt="Hero Image" style="width: 400px;" />
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="file" name="hero_image" class="form-control border-0 w-50"
                                                accept="image/*" id="input_hero_image" />
                                            @error('hero_image')
                                                <div class="invalid-feedback">{{ $message }}></div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="title">Heading</label>
                                        <input type="text" name="title" id="title"
                                            value="{{ $hero_section->title }}"
                                            class="form-control @error('title')
                                                is-invalid
                                            @enderror"
                                            placeholder="Title">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Sub Heading</label>
                                        <input type="text" name="subtitle" id="subtitle"
                                            value="{{ $hero_section->subtitle }}"
                                            class="form-control @error('subtitle') is-invalid @enderror"
                                            placeholder="subtitle">
                                        @error('subtitle')
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
            .getElementById("input_hero_image")
            .addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("hero_image").src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
@endsection
@endsection
