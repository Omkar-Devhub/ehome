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
                    <div class="card-body">
                        @if ($property->images->count() > 0)
                            <div id="propertyCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
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
                                <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif
                        <h2 class="mt-3">{{ $property->address }},
                            {{ Str::title($property->area->name) }},
                            {{ Str::title($property->county->name) }}, {{ $property->eircode }}</h2>
                        <h1 class="mt-3 font-weight-bold">
                            {{ Config::get('settings.currency_symbol') }}{{ $property->price }} @if (!empty($property->rent_type))
                                / {{ $property->rent_type }}
                            @endif
                        </h1>
                        {{-- Property Details --}}
                        <hr>
                        <h2>Property Details</h2>
                        <div class="grid-container">
                            <div>ID : {{ $property->id }}</div>
                            <div>Bedrooms :
                                {{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}
                            </div>
                            <div>Bathrooms : {{ $property->bath_rooms }}</div>
                            <div>Property Size :
                                {{ $property->property_size ?? 'N/A' }}@if (!empty($property->property_size))
                                    {{ $property->units }}
                                @endif
                            </div>
                            <div>Ads Type : {{ Str::title($property->adType->name) }}</div>
                            <div>Property Type : {{ Str::title($property->type->name) }}</div>
                            <div>Ads Category : {{ Str::title($property->category->name) }}</div>
                            <div>Available From : {{ $property->available_from ?? 'N/A' }}</div>
                            <div>Lease : {{ $property->lease ?? 'N/A' }}</div>
                            <div>Furnishing : {{ $property->furnishing_status ?? 'N/A' }}</div>
                            <div>
                                @if ($property->ber->icon)
                                    <img src="{{ asset('uploads/ber/' . $property->ber->icon) }}" alt=""
                                        srcset="">
                                @else
                                    N/A
                                @endif
                            </div>
                            <div>BER No : {{ $property->ber_no ?? 'N/A' }}</div>
                            <div>Plan : {{ $property->plan_id ?? 'N/A' }}</div>
                            <div>
                                @if ($property->propertyable_type === 'App\Models\User')
                                    User: {{ $property->propertyable->name }}
                                @elseif ($property->propertyable_type === 'App\Models\Agent')
                                    Agent: {{ $property->propertyable->name }}
                                @endif
                            </div>
                            <div>
                                @if ($property->propertyable_type === 'App\Models\User')
                                    User: {{ $property->propertyable->email }}
                                @elseif ($property->propertyable_type === 'App\Models\Agent')
                                    Agent: {{ $property->propertyable->email }}
                                @endif
                            </div>
                            <div>Created At : {{ $property->created_at->diffForHumans() }}</div>
                            <div>Updated At : @if ($property->updated_at)
                                    {{ $property->updated_at->diffForHumans() }}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        {{-- End Property Details --}}
                        @if ($property->facilities)
                            <hr>
                            <h2>Facilities</h2>
                            @php
                                $itemsArray = explode(', ', $property->facilities); // Convert string to array
                            @endphp
                            <ul>
                                @foreach ($itemsArray as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <hr>
                        <h2>Property Description</h2>
                        <p>{!! nl2br($property->description) !!}</p>
                        <hr>
                        @if ($property->nearBy->count() > 0)
                            <h2>Near By</h2>
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach ($property->nearBy as $nearBy)
                                        <tr>
                                            <td>{{ $nearBy->location }}</td>
                                            <td>{{ $nearBy->distance }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <hr>
                        <h2>Property Location</h2>
                        <div class="mb-3" id="map" style="width: 100%; height: 400px"></div>
                        <button type="button" onclick="openSatelliteViewWithMarker()" class="btn btn-default">Satellite
                            View</button>
                        <button type="button" onclick="openStreetView()" class="btn btn-default">Street View</button>
                        <div class="mt-3">
                            <form action="{{ route('admin.properties.status.update', $property->id) }}') }}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-2">
                                        <!-- select -->
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label>Update Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="0" {{ $property->status == 0 ? 'selected' : '' }}>
                                                        in Review</option>
                                                    <option value="1" {{ $property->status == 1 ? 'selected' : '' }}>
                                                        Approve</option>
                                                    <option value="2" {{ $property->status == 2 ? 'selected' : '' }}>
                                                        Reject</option>
                                                    <option value="4" {{ $property->status == 4 ? 'selected' : '' }}>
                                                        Sold</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="mb-3">
                                            <label>Reason</label>
                                            <input type="text" class="form-control" name="reason"
                                                value="{{ $property->comments }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    @section('custom-js')
        <script>
            var map = L.map('map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 18);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            L.marker([{{ $property->latitude }}, {{ $property->longitude }}]).addTo(map);

            function openSatelliteViewWithMarker() {
                var lat = {{ $property->latitude }}; // Example: Dublin, Ireland
                var lng = {{ $property->longitude }};
                var zoom = 17; // Adjust zoom level (higher number = closer view)

                var satelliteViewUrl = `https://www.google.com/maps/@${lat},${lng},${zoom}z/data=!3m1!1e3?q=${lat},${lng}`;

                window.open(satelliteViewUrl, '_blank');
            }

            function openStreetView() {
                var lat = {{ $property->latitude }}; // Example: Dublin, Ireland
                var lng = {{ $property->longitude }};
                var streetViewUrl = `https://www.google.com/maps?q=&layer=c&cbll=${lat},${lng}`;

                window.open(streetViewUrl, '_blank');
            }
        </script>
    @endsection
@endsection
