@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Create Post</h1>
                    <a href="{{ route('admin.blogs-posts') }}" class="btn btn-dark">Back</a>
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
                <form action="{{ route('admin.blogs-posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    placeholder="Title" value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="slug">Permalink</label>
                                                <input type="text" name="slug" id="slug"
                                                    class="form-control @error('slug') is-invalid @enderror"
                                                    placeholder="Slug" value="{{ old('slug') }}" readonly>
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="content">Content</label>
                                                <textarea name="content" id="content" class="summernote @error('content') is-invalid @enderror" cols="30"
                                                    rows="25"></textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <img src="{{ asset('uploads/placeholder.png') }}"
                                                    class="img-fluid img-thumbnail" id="featured_image_preview"
                                                    alt="" srcset="">
                                                <label for="featured_image">Featured Image</label>
                                                <div class="custom-file">
                                                    <input type="file" name="featured_image" accept="image/*"
                                                        id="featured_image" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose Featured
                                                        Image</label>
                                                </div>
                                            </div>
                                            @if (!empty($categories))
                                                <div class="mb-3">
                                                    <label for="name">Select Category</label>
                                                    <select name="category_id" id="category"
                                                        class="form-control @error('category_id') is-invalid @enderror">
                                                        <option value="">Select Category</option>
                                                        @if ($categories->count() > 0)
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="">No Category</option>
                                                        @endif
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="status"
                                                        name="status">
                                                    <label class="custom-control-label" for="status">Status</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-dark"> <i class="fas fa-save"></i>
                                                    Save</button>
                                                <a href="{{ route('admin.blogs-posts') }}" class="btn btn-light ml-2"> <i
                                                        class="fas fa-times"></i>
                                                    Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@section('custom-js')
    <script>
        $('#title').change(function() {
            element = $(this);
            $.ajax({
                url: "{{ route('get.slug') }}",
                type: "get",
                data: {
                    title: element.val()
                },
                dataType: "json",
                success: function(response) {
                    if (response['status'] == 'success') {
                        $('#slug').val(response['slug']);
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 400
            });
        });

        document
            .getElementById("featured_image")
            .addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("featured_image_preview").src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
@endsection
@endsection
