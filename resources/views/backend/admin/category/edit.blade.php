@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Edit Category</h1>
                    <a href="{{ route('admin.category') }}" class="btn btn-dark">Back</a>
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
                    <form action="{{ route('admin.category.update', $category->id) }}') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="category_name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Category name" value="{{ old('name', $category->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
        $('#category_name').change(function() {
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
                        $('#category_slug').val(response['slug']);
                    }
                }
            });
        });
    </script>
@endsection
@endsection
