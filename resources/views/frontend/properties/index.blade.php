@extends('frontend.layout.master')
@section('title', 'Properties')
@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between">
            <h2>{{ ucfirst($adType->name) }} Properties {{ $propertyTypeSlug ? ' - ' . ucfirst($propertyTypeSlug) : '' }}
            </h2>
            <button class="btn btn-light border-dark d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#filter-canvas" aria-controls="filter-canvas">Filter&nbsp;<i class="fas fa-filter"></i>
            </button>
        </div>
        <p class="mb-0" style="font-size: 0.8rem;">There are currently {{ count($properties) }} properties.</p>
        <div class="row">
            <div class="col-4 d-none d-lg-block">
                <div class="card mt-2">
                    <div class="card-body">
                        @include('frontend.layout.partials.filter')
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    @if ($properties->count() > 0)
                        @foreach ($properties as $property)
                            <div class="col-md-6 mt-2">
                                <a href="{{ route('property.show', ['type' => $property->adType->name, 'slug' => $property->slug]) }}"
                                    class="text-decoration-none">
                                    <div class="property-card position-relative">
                                        <!-- Thumbnail with Location Overlay and Badges -->
                                        <div class="thumbnail">
                                            <img src="{{ asset($property->firstImage->image ?? 'placeholder.png') }}"
                                                alt="Property Thumbnail">
                                            {{-- <!-- Badges -->
                                        <div class="badges">
                                            <span class="badge">Featured</span>
                                            <span class="badge for-sale">For Sale</span>
                                        </div> --}}
                                        </div>

                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <!-- Title -->
                                            <h5 class="card-title" style="color: #38b76c">{{ $property->address }},
                                                {{ Str::title($property->area->name) }},
                                                {{ Str::title($property->county->name) }}, {{ $property->eircode }}</h5>

                                            <!-- Property Details -->
                                            <div class="d-flex flex-row justify-content-between">
                                                <p class="card-text mb-0">
                                                    @if ($property->single_bedrooms != '' || $property->double_bedrooms != '' || $property->twin_bedrooms != '')
                                                        <i class="fas fa-bed"></i>
                                                        {{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}
                                                        Beds &nbsp;
                                                    @endif
                                                    @if ($property->bath_rooms != '')
                                                        <i class="fas fa-bath"></i> {{ $property->bath_rooms }} Baths
                                                        &nbsp;
                                                    @endif
                                                    <i class="fas fa-ruler-combined"></i> {{ $property->property_size }}
                                                    {{ $property->units }}
                                                </p>
                                                <img src="{{ asset('uploads/ber/' . $property->ber->icon ?? 'placeholder.png') }}"
                                                    alt="">
                                            </div>

                                            <!-- Horizontal Rule -->
                                            <hr>

                                            <!-- Profile Picture and Price in a Row -->
                                            <div class="profile-price-row">
                                                <!-- Agent Info -->
                                                <div class="agent-info">
                                                    @if ($property->propertyable->photo)
                                                        <img src="{{ asset('uploads/profile_images/' . $property->propertyable->photo ?? 'placeholder.png') }}"
                                                            alt="Profile Picture"
                                                            style="border: #38b76c 2px solid; border-radius: 50%;">
                                                    @endif
                                                    <span class="agent-name fw-bold">
                                                        @if ($property->propertyable_type === 'App\Models\User')
                                                            {{ $property->propertyable->name }}
                                                        @elseif ($property->propertyable_type === 'App\Models\Agent')
                                                            {{ $property->propertyable->name }}
                                                        @endif
                                                    </span>
                                                </div>

                                                <!-- Price -->
                                                <div class="price">
                                                    {{ Config()->get('settings.currency_symbol') }}{{ number_format($property->price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <h2 class="text-center">No properties found</h2>
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-end">
                    {{ $properties->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filter-canvas">
        <div class="offcanvas-header">
            <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas"
                data-bs-target="#filter-canvas"></button>
        </div>
        <div class="offcanvas-body">
            @include('frontend.layout.partials.filter')
        </div>
    </div>
@endsection
