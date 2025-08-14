@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>{{ $property->address }},
                        {{ Str::title($property->area->name) }},
                        {{ Str::title($property->county->name) }}, {{ $property->eircode }}</h1>
                    <a href="{{ route('admin.properties') }}" class="btn btn-dark">Back</a>
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
                    <form action="{{ route('admin.properties.update', $property->id) }}') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if ($property->images->count() > 0)
                                <div id="propertyCarousel" class="carousel slide" data-ride="carousel" height="300px">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        @foreach ($property->images as $key => $image)
                                            <li data-target="#propertyCarousel" data-slide-to="{{ $key }}"
                                                class="{{ $key === 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>

                                    <!-- Slides -->
                                    <div class="carousel-inner">
                                        @foreach ($property->images as $key => $image)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image->image) }}" class="d-block w-100"
                                                    alt="Property Image {{ $key + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Controls -->
                                    <a class="carousel-control-prev" href="#propertyCarousel" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#propertyCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
