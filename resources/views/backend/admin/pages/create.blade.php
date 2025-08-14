@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Create Page</h1>
                    <a href="{{ route('admin.pages') }}" class="btn btn-dark">Back</a>
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
                    <form action="{{ route('admin.pages.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title">Name</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror" placeholder="Name">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Slug</label>
                                        <input type="text" name="slug" id="slug"
                                            class="form-control @error('slug') is-invalid @enderror" placeholder="Slug">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="content">Content</label>
                                        <textarea name="content" id="content" class="summernote @error('content') is-invalid @enderror" cols="30"
                                            rows="10"></textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="name">Select Category</label>
                                            <select name="menu_name" id="menu_name" class="form-control">
                                                <option value="eirehome">Eirehome
                                                </option>
                                                <option value="legal">
                                                    Legal
                                                </option>
                                            </select>
                                        </div>
                                    </div>
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
                height: 300
            });
        });
    </script>
@endsection
@endsection
