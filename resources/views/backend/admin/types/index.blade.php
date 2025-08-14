@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Property Types</h1>
                    <a href="{{ route('admin.property-types.create') }}" class="btn btn-dark">Add Property Type</a>
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
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" class="btn btn-default btn-sm"
                                onclick="window.location.href ='{{ route('admin.property-types') }}'">Reset</button>
                        </div>
                        <div class="card-tools">
                            <form action="" method="GET">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}"
                                        class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Name </th>
                                    <th>Category</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($property_types->count() > 0)
                                    @foreach ($property_types as $property_type)
                                        <tr>
                                            <td>{{ $property_types->firstItem() + $loop->index }}</td>
                                            <td>{{ $property_type->name }}</td>
                                            <td>{{ $property_type->category->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.property-types.edit', $property_type->id) }}"
                                                    class="w-4 h-4 mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.property-types.delete', $property_type->id) }}"
                                                    class="text-danger w-4 h-4 mr-1">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No categories found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $property_types->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@section('custom-js')
@endsection
@endsection
