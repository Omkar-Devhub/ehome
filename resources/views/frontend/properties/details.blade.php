@extends('frontend.layout.master')
@section('title', 'Properties')
@section('content')
    @if ($property->propertyable_type === 'App\Models\Agent')
        <section class="d-flex justify-content-center align-items-center"
            style="height: 60px; background: var(--bs-border-color)">
            <img class="img-fluid" src="assets/img/vendor_logo.png" width="156" height="60">
        </section>
    @else
        <div class="mt-3"></div>
    @endif
    <div class="container mb-4">
        <div class="row">
            <div class="col-12 col-lg-8">
                <!-- Image Container -->
                @if ($property->images->count() > 0)
                    <div class="image-container">
                        <!-- Big First Image -->
                        <div>
                            <img src="{{ asset($property->images[0]->image) }}" class="big-image" data-bs-toggle="modal"
                                data-bs-target="#lightboxModal" data-bs-slide-to="0">
                        </div>

                        <!-- Smaller Images Grid -->
                        <div class="small-images">
                            <img src="{{ asset($property->images[1]->image) }}" data-bs-toggle="modal"
                                data-bs-target="#lightboxModal" data-bs-slide-to="1">
                            <img src="{{ asset($property->images[2]->image) }}" data-bs-toggle="modal"
                                data-bs-target="#lightboxModal" data-bs-slide-to="2">
                        </div>
                    </div>
                    <!-- Lightbox Modal -->
                    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div id="lightboxCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($property->images as $key => $image)
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($image->image) }}" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#lightboxCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#lightboxCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <h4 class="fw-normal mt-3">
                    {{ $property->address }},
                    {{ Str::title($property->area->name) }},
                    {{ Str::title($property->county->name) }}, {{ $property->eircode }}
                </h4>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold mt-3">
                        {{ Config::get('settings.currency_symbol') }}{{ number_format($property->price, 2) }}</h2>
                    @if (auth()->check())
                        <div>
                            <div class="btn-group gap-2" role="group">
                                <button class="btn btn-light border-1 favorite-btn" type="button"
                                    data-property-id="{{ $property->id }}">
                                    <i
                                        class="far fa-heart {{ auth()->check() && $property->isFavoritedBy(auth()->user()) ? 'fas text-danger' : 'far' }}"></i>
                                </button>
                                <button class="btn btn-light border-1" type="button">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                <button class="btn btn-light border-1" type="button">
                                    <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <div>
                    <div>
                        <p style="margin-bottom: 8px">
                            <i class="fas fa-map-marker-alt"></i>&nbsp; 145 Brooklyn Ave,
                            {{ $property->address }},
                            {{ Str::title($property->area->name) }},
                            {{ Str::title($property->county->name) }}, {{ $property->eircode }}
                        </p>
                    </div>
                    <div class="d-flex">
                        @if ($property->single_bedrooms != '')
                            <p class="me-3" style="margin-bottom: 0">
                                <i class="fas fa-bed"></i>&nbsp;Beds:
                                <strong>{{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}</strong>
                            </p>
                        @endif
                        @if ($property->bath_rooms != '')
                            <p class="me-3" style="margin-bottom: 0">
                                <i class="fas fa-bath"></i>&nbsp;Baths: <strong>{{ $property->bath_rooms }}</strong>
                            </p>
                        @endif
                        <p style="margin-bottom: 0">
                            <i class="fas fa-ruler-combined"></i>&nbsp;{{ $property->units }}:
                            <strong>{{ $property->property_size }}</strong>
                        </p>
                    </div>
                </div>
                <hr>
                <h4 class="my-3"><strong>Propety Details</strong></h4>
                <div class="d-grid gap-3" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))">
                    <div>
                        <span class="fw-bold">ID:</span>
                        <span>#{{ $property->id }}</span>
                    </div>
                    @if ($property->single_bedrooms != '')
                        <div>
                            <span class="fw-bold">Bedrooms:</span>
                            <span>{{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}</span>
                        </div>
                    @endif
                    @if ($property->bath_rooms != '')
                        <div>
                            <span class="fw-bold">Bathrooms:</span>
                            <span>{{ $property->bath_rooms }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="fw-bold">Size:</span>
                        <span>{{ $property->property_size }} {{ $property->units }}</span>
                    </div>
                    <div>
                        <span class="fw-bold">Status:</span>
                        <span>For {{ Str::title($property->adType->name) }}</span>
                    </div>
                    <div>
                        <span class="fw-bold">Type:</span>
                        <span>{{ Str::title($property->type->name) }}</span>
                    </div>
                    @if ($property->furnishing_status != '')
                        <div>
                            <span class="fw-bold">Furnishing:</span>
                            <span>{{ $property->furnishing_status ?? 'N/A' }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="fw-bold">Price:</span>
                        <span>{{ Config::get('settings.currency_symbol') }}{{ number_format($property->price, 2) }}</span>
                    </div>
                </div>
                <hr>
                <h4 class="my-3"><strong>Description</strong></h4>
                <p>
                    {{ nl2br($property->description) }}
                </p>
                @if ($property->facilities)
                    <hr>
                    <h4 class="my-3"><strong>Amenities &amp; Features</strong></h4>
                    <div class="d-grid gap-3" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr))">

                        @foreach ($property->facilities as $facility)
                            <div>
                                <li>{{ $facility->name }}</li>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($property->video)
                    <hr>
                    <h4 class="my-3"><strong>Video</strong></h4>
                    {!! $property->video !!}
                @endif
                <hr>
                <div class="d-flex flex-row justify-content-between align-items-center py-2">
                    <h4><strong>Map Location</strong></h4>
                    <div>
                        <button class="btn btn-light me-2" type="button" onclick="openStreetView()"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Street View">
                            <i class="fas fa-street-view"></i>
                        </button>
                        <button class="btn btn-light" type="button" onclick="openSatelliteViewWithMarker()"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Satellite View">
                            <i class="fas fa-globe"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3" id="map" style="width: 100%; height: 400px"></div>
                {{-- @if ($property->floorplans->count() > 0)
                    <hr>
                    <h4 class="my-3"><strong>Floor Plans</strong></h4>
                    <div class="accordion" role="tablist" id="accordion-1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-1 .item-1" aria-expanded="false"
                                    aria-controls="accordion-1 .item-1">
                                    Accordion Item
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse item-1" role="tabpanel"
                                data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="mb-0">
                                        Nullam id dolor id nibh ultricies vehicula ut id elit. Cras
                                        justo odio, dapibus ac facilisis in, egestas eget quam.
                                        Donec id elit non mi porta gravida at eget metus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#accordion-1 .item-2" aria-expanded="false"
                                    aria-controls="accordion-1 .item-2">
                                    Accordion Item
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse item-2" role="tabpanel"
                                data-bs-parent="#accordion-1">
                                <div class="accordion-body">
                                    <p class="mb-0">
                                        Nullam id dolor id nibh ultricies vehicula ut id elit. Cras
                                        justo odio, dapibus ac facilisis in, egestas eget quam.
                                        Donec id elit non mi porta gravida at eget metus.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}
                {{-- @if ($property->files->count() > 0)
                    <hr>
                    <h4 class="my-3"><strong>File Attachments</strong></h4>
                    <div>
                        <button class="btn btn-light me-3 my-2" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-download">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5">
                                </path>
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                </path>
                            </svg>&nbsp;Villa_Document.pdf</button><button class="btn btn-light me-3 my-2" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-download">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5">
                                </path>
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                </path>
                            </svg>&nbsp;Villa_Document.pdf
                        </button>
                    </div>
                @endif --}}
                @if ($property->nearBy->count() > 0)
                    <hr>
                    <h4 class="my-3"><strong>What’s nearby?</strong></h4>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                @foreach ($property->nearBy as $nearBy)
                                    <tr>
                                        <td>{{ $nearBy->location }}</td>
                                        <td>{{ $nearBy->distance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <hr>
                <h4 class="my-3"><strong>BER Details</strong></h4>
                <div class="d-flex justify-content-between">
                    <img class="img-fluid" src="{{ asset('uploads/ber/' . $property->ber->icon) }}">
                    <p class="mb-0"><strong>BER No : {{ $property->ber_no ?? 'N/A' }}</strong></p>
                </div>
                <hr>
                <div class="my-5">
                    <a class="text-decoration-none" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                            viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2">
                            </path>
                        </svg>&nbsp; Report this Ad</a>
                </div>
                @if ($property->propertyable_type === 'App\Models\Agent')
                    <div class="my-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4" style="border-right: 5px solid var(--bs-primary)">
                                        <div class="d-flex flex-column align-items-center">
                                            @if ($property->propertyable_type === 'App\Models\Agent')
                                                <img class="img-fluid" src="assets/img/vendor_logo.png"
                                                    style="width: 200px">
                                            @endif
                                            <img class="img-fluid" src=""
                                                style="
                                                width: 150px;
                                                height: 150px;
                                                border-radius: 8px;
                                                border: 2px solid var(--bs-primary);
                                            ">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 d-flex flex-column justify-content-center"
                                        style="border-right: 5px solid var(--bs-primary)">
                                        <div>
                                            <h3><strong>{{ $property->propertyable->name }}</strong></h3>
                                            <p class="mb-1"><strong>Company Name</strong></p>
                                            <p class="mb-1">
                                                <strong>PSR License Number:&nbsp;</strong>
                                            </p>
                                            <p class="mb-1">
                                                <strong>Phone No. +536 **********</strong>
                                            </p>
                                            <p class="mb-1">
                                                <strong>Email : cha*******@gmail.com</strong>
                                            </p>
                                            <button class="btn btn-primary link-light mt-2" type="button">
                                                View All Properties
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($similarProperties->count() > 0)
                    <div>
                        <h4 class="my-3"><strong>Similar Properties</strong></h4>
                        @foreach ($similarProperties as $similarProperty)
                            <a href="{{ route('property.show', ['type' => $similarProperty->adType->name, 'slug' => $similarProperty->slug]) }}"
                                class="text-decoration-none">
                                <div class="similar-property-card">
                                    <div>
                                        <img src="{{ asset($similarProperty->firstImage->image ?? 'placeholder.png') }}"
                                            alt="Property Thumbnail" class="similar-property-thumbnail">
                                    </div>
                                    <div class="similar-property-details">
                                        <div class="similar-property-name">
                                            {{ Str::ucfirst($similarProperty->address) }},
                                            {{ Str::ucfirst($similarProperty->area->name) }},
                                            {{ Str::ucfirst($similarProperty->county->name) }},
                                            {{ Str::ucfirst($similarProperty->eircode) }}</div>
                                        <div class="similar-property-amount">{{ Config::get('settings.currency_symbol') }}
                                            {{ $similarProperty->price }}</div>
                                        <div class="similar-property-features">
                                            {{ $similarProperty->single_bedrooms + $similarProperty->double_bedrooms + $similarProperty->twin_bedrooms }}
                                            Beds | {{ $similarProperty->bath_rooms }} Baths |
                                            {{ Str::title($similarProperty->type->name) }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col d-none d-lg-block">
                <div class="card">
                    <div class="card-body">
                        <div id="agent-details">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-12">
                                    <div class="d-flex flex-column align-items-center">
                                        @if ($property->propertyable_type === 'App\Models\Agent')
                                            <img class="img-fluid" src="assets/img/vendor_logo.png" style="width: 200px">
                                        @endif
                                        @if (isset($property->propertyable->photo) &&
                                                file_exists(public_path('uploads/profile_images/' . $property->propertyable->photo)))
                                            <img src="{{ asset('uploads/profile_images/' . $property->propertyable->photo) }}"
                                                style="
                                            width: 150px;
                                            height: 150px;
                                            border-radius: 8px;
                                            border: 2px solid var(--bs-primary);
                                            "
                                                alt="Profile Image">
                                        @else
                                            <img src="{{ asset('uploads/profile_images/profile.png') }}"
                                                style="
                                            width: 150px;
                                            height: 150px;
                                            border-radius: 8px;
                                            border: 2px solid var(--bs-primary);
                                            "
                                                alt="Default Profile Image">
                                        @endif
                                    </div>
                                </div>
                                <div
                                    class="col-12 col-md-8 col-lg-12 d-flex flex-column justify-content-center align-items-center">
                                    <div class="text-center">
                                        <h3 class="text-center"><strong>{{ $property->propertyable->name }}</strong></h3>
                                        @if (!empty($property->propertyable->phone) && $property->phone_number_visiblity == 1)
                                            <p class="mb-1"><strong>Phone No.
                                                    {{ $property->propertyable->phone }}</strong>
                                            </p>
                                        @endif
                                        @if ($property->propertyable->email)
                                            <p class="mb-1"><strong>Email :
                                                    {{ $property->propertyable->email }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <form class="px-3" action="{{ route('user.inquiries', $property->id) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <textarea class="shadow-none form-control" placeholder="Your message" rows="5" name="message">Is this property still on the market? If yes, what is the latest offer, and when is the next viewing?</textarea>
                                </div>
                                <div class="d-grid mb-2">
                                    <button class="btn btn-primary link-light shadow-none mt-2 shadow-none"
                                        type="submit">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                            <div class="d-grid mb-2 px-3">
                                <button class="btn btn-light shadow-none mt-2 shadow-none" type="button">
                                    See Other Properties
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="my-3">
                    <img class="img-fluid" src="assets/img/placeholder_ads.png">
                </div> --}}
            </div>
        </div>
        <!-- Floating Button -->
        <button class="floating-btn d-lg-none" data-bs-toggle="modal" data-bs-target="#emailModal">
            <i class="far fa-envelope"></i> Email Agent
        </button>

        <!-- Modal -->
        <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailModalLabel">Contact Agent</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body my-4" id="agent-modal">
                        <h1>Contact Agent</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        var map = L.map('map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 18);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        L.marker([{{ $property->latitude }}, {{ $property->longitude }}]).addTo(map)

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

        // Favorite
        $(document).ready(function() {
            $('.favorite-btn').click(function(e) {
                e.preventDefault();
                const propertyId = $(this).data('property-id');
                const button = $(this);

                $.ajax({
                    url: '{{ route('property.toggle-favorite') }}',
                    type: 'POST',
                    data: {
                        property_id: propertyId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'added') {
                            button.find('i').removeClass('far').addClass('fas text-danger');
                            toastr.success('Added to favorites!');
                        } else if (response.status === 'removed') {
                            button.find('i').removeClass('fas text-danger').addClass('far');
                            toastr.info('Removed from favorites!');
                        } else if (response.status === 'login_required') {
                            window.location.href = '{{ route('login') }}';
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
@endsection
