@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Registration Requests</h1>
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
                                onclick="window.location.href ='{{ route('admin.registration-requests') }}'">Reset</button>

                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-download"></i> Export
                                Excel</button>
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
                                    <th>Reg. Type</th>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Requested At</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($registration_requests->count() > 0)
                                    @foreach ($registration_requests as $registration_request)
                                        <tr>
                                            <td>{{ $registration_requests->firstItem() + $loop->index }}</td>
                                            <td>{{ Str::ucfirst($registration_request->reg_type) }}</td>
                                            <td>{{ $registration_request->name }}</td>
                                            <td>{{ $registration_request->email }}</td>
                                            <td>{{ $registration_request->phone }}</td>
                                            <td>{{ $registration_request->address }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($registration_request->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin.vendor.invite', $registration_request->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    Invite
                                                </a>
                                                <a href="{{ route('admin.registration-requests.delete', $registration_request->id) }}"
                                                    class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No Request found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $registration_requests->links() }}
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
