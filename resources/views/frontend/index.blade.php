@extends('frontend.layout.master')
@section('title', 'EireHome - Property Listings for Rent & Sale in Ireland')
@section('content')
    <div class="promo-marquee">
        <div class="scrolling-text">
            <span>🌟 Exclusive Offer for Estate Agents and Individuals to Register Properties for Sale and Rent — 6-Month
                Free Promotion Period! 🌟</span>
            <span>🌟 Exclusive Offer for Estate Agents and Individuals to Register Properties for Sale and Rent — 6-Month
                Free Promotion Period! 🌟</span>
        </div>
    </div>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-image: url('{{ asset('uploads/frontend_images/' . getHeroSection()->image) }}')">
        <div class="container">
            <h1>{{ getHeroSection()->title }}</h1>
            <p>{{ getHeroSection()->subtitle }}</p>

            <!-- Property Search Form -->
            @include('frontend.layout.partials.property_search')
        </div>
    </div>
    {{-- Ads Banner --}}
    {{-- <div class="container text-center my-3">
        <img class="img-fluid" src="{{ asset('frontend/assets/img/banner_ads_970x90.png') }}" style="border-radius: 5px;">
    </div> --}}
    {{-- Ads Banner End --}}
    {{-- @if ($featured_section->status == 1)
        <div class="container my-5">
            <p class="fs-6 sub-heading" style="font-size: 12px;margin-bottom: 0px;">{{ $featured_section->title }}</p>
            <h1 class="fs-2 fw-bold">{{ $featured_section->heading }}</h1>
            <div class="container my-3">
                <div class="row">
                    @if ($featured_properties->count() > 0)
                        @foreach ($featured_properties as $property)
                            <div class="col-md-6 col-lg-4 mt-2">
                                <a href="{{ route('property.show', ['type' => $property->adType->name, 'slug' => $property->slug]) }}"
                                    class="text-decoration-none">
                                    <div class="property-card position-relative">
                                        <!-- Thumbnail with Location Overlay and Badges -->
                                        <div class="thumbnail">
                                            <img src="{{ asset($property->firstImage->image ?? 'placeholder.png') }}"
                                                alt="Property Thumbnail">
                                            <!-- Badges -->
                                            <div class="badges">
                                                @if ($property->is_featured == 1)
                                                    <span class="badge">Featured</span>
                                                @endif
                                                <span class="badge for-sale">For
                                                    {{ Str::title($property->adType->name) }}</span>
                                            </div>
                                        </div>

                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <!-- Title -->
                                            <h5 class="card-title">{{ $property->address }}, {{ $property->area->name }},
                                                {{ $property->county->name }}, {{ $property->eircode }}</h5>

                                            <!-- Property Details -->
                                            <p class="card-text">
                                                <i class="fas fa-bed"></i>
                                                {{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}
                                                Beds &nbsp;
                                                <i class="fas fa-bath"></i> {{ $property->bath_rooms }} Baths &nbsp;
                                                <i class="fas fa-ruler-combined"></i> {{ $property->property_size }}
                                                {{ $property->units }}
                                            </p>

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
                    @endif
                </div>
            </div>
        </div>
    @endif --}}
    <div class="container my-4">
        <p class="fs-6 sub-heading" style="font-size: 12px; margin-bottom: 0px;">EXPLORE CITIES</p>
        <h1 class="fs-2 fw-bold">Location For You</h1>
        <div class="row mt-3">
            @foreach ($counties as $county)
                <div class="col-6 col-md-3 mb-2">
                    <!-- 2 columns on mobile (col-6), 4 columns on medium and larger (col-md-3) -->
                    <a href="{{ route('properties.county', $county->name) }}" class="text-decoration-none text-dark">
                        {{ Str::title($county->name) }} ({{ $county->active_properties_count }})
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @if ($blogs->count() > 0)
        <div class="container my-5">
            <p class="fs-6 sub-heading" style="font-size: 12px;margin-bottom: 0px;">LATEST NEW</p>
            <h1 class="fs-2 fw-bold">From Our Blog</h1>
            <div class="container my-4">
                <div class="row g-4">
                    <!-- Blog Card 1 -->
                    @foreach ($blogs as $blog)
                        <div class="col-md-4">
                            <div class="blog-card">
                                <img src="{{ asset('uploads/blogs/' . $blog->featured_image) }}" alt="Blog 1"
                                    class="blog-image">
                                <div class="blog-content">
                                    <a href="#" class="blog-title">{{ $blog->title }}</a>
                                    <p class="blog-description">{{ Str::limit(strip_tags($blog->content), 120, '...') }}
                                    </p>
                                    <a href="#" class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
