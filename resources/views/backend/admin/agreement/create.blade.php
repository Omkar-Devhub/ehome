@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Send Agreement</h1>
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
                    <form action="{{ route('admin.agreements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="name">Select Agent</label>
                                            <select name="agent_id"
                                                class="form-control @error('agnet_id') is-invalid @enderror">
                                                <option value="">Select Agent</option>
                                                @if ($agents->count() > 0)
                                                    @foreach ($agents as $agent)
                                                        <option value="{{ $agent->id }}">
                                                            {{ Str::title($agent->full_name) }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Agent Found</option>
                                                @endif
                                            </select>
                                            @error('county_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="agreement">Choose Agreement PDF</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input  @error('agreement') is-invalid @enderror"
                                                id="customFile" name="agreement" accept=".pdf, application/pdf">
                                            <label class="custom-file-label" for="customFile">Choose Agreement file</label>
                                            @error('agreement')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark">Send Agreement Email</button>
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
