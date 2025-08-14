@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Propertises</h1>
                    {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-dark">Add Category</a> --}}
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
                                onclick="window.location.href ='{{ route('admin.properties') }}'">Reset</button>
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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Price </th>
                                    <th>Ad Type</th>
                                    <th>Views</th>
                                    <th>Created At</th>
                                    <th>Posted By</th>
                                    <th>Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($porperties->count() > 0)
                                    @foreach ($porperties as $property)
                                        <tr>
                                            <td>{{ $porperties->firstItem() + $loop->index }}</td>
                                            <td> <img src="{{ asset($property->firstImage->image ?? 'placeholder.png') }}"
                                                    class="img-thumbnail" width="50" alt="">
                                            </td>
                                            <td>{{ $property->address }},
                                                {{ Str::title($property->area->name) }},
                                                {{ Str::title($property->county->name) }}, {{ $property->eircode }}</td>
                                            <td>{{ Config::get('settings.currency_symbol') }}
                                                {{ $property->price }}</td>
                                            <td>{{ Str::title($property->adType->name) }}</td>
                                            <td>{{ $property->views }}</td>
                                            <td>{{ $property->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($property->propertyable_type === 'App\Models\User')
                                                    User: {{ $property->propertyable->name }}
                                                @elseif ($property->propertyable_type === 'App\Models\Agent')
                                                    Agent: {{ $property->propertyable->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($property->status == 0)
                                                    <span class="badge badge-warning">In Review</span>
                                                @elseif($property->status == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif($property->status == 2)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @elseif ($property->status == 3)
                                                    <span class="badge badge-light">Expired</span>
                                                @elseif ($property->status == 4)
                                                    <span class="badge badge-secondary">Sold</span>
                                                @elseif ($property->status == 5)
                                                    <span class="badge badge-dark">Archived</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.properties.preview', $property->id) }}"
                                                    class="w-4 h-4 mr-2">
                                                    <i class="text-success far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.properties.edit', $property->id) }}"
                                                    class="w-4 h-4 mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.users.delete', $property->id) }}"
                                                    class="text-danger w-4 h-4 mr-1">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">No Property found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $porperties->links() }}
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
