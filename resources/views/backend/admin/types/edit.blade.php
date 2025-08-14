@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Edit Property Type</h1>
                    <a href="{{ route('admin.property-types') }}" class="btn btn-dark">Back</a>
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
                    <form action="{{ route('admin.property-types.update', $property_type->id) }}') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @if ($property_categories->count() > 0)
                                    <div class="col-12 col-lg-6">
                                        <div class="mb-3">
                                            <label for="name">Select Property Category</label>
                                            <select name="category"
                                                class="form-control @error('category') is-invalid @enderror">
                                                <option value="">Select Category</option>
                                                @foreach ($property_categories as $property_category)
                                                    <option value="{{ $property_category->id }}"
                                                        {{ $property_type->property_category_id == $property_category->id ? 'selected' : '' }}>
                                                        {{ $property_category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Property type name"
                                            value="{{ old('name', $property_type->name) }}">
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
@endsection
