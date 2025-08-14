@extends('frontend.layout.master')
@section('title', 'My Properties')
@section('content')
    <div class="container my-4">
        <div class="mt-2" style="min-height: 600px;max-width: 600px;margin: 0 auto;">
            {{-- Toast Message --}}
            @if (session('toast'))
                @if (session('toast.type') == 'success')
                    <x-bs5-toast type="{{ session('toast.type', 'success') }}" message="{{ session('toast.message') }}" />
                @else
                    <x-bs5-toast type="{{ session('toast.type', 'danger') }}" message="{{ session('toast.message') }}" />
                @endif
            @endif
            <h2>My Properties</h2>
            <p class="mb-3" style="font-size: 0.8rem;">There are currently
                @if (count($properties) == 1 || count($properties) == 0)
                    {{ count($properties) }} property.
                @else
                    {{ count($properties) }} properties.
                @endif
            </p>
            <!-- Property Card 1 -->
            @if (!empty($properties))
                @foreach ($properties as $property)
                    <div class="similar-property-card">
                        <div>
                            <img src="{{ asset($property->firstImage->image ?? 'placeholder.png') }}"
                                alt="Property Thumbnail" class="similar-property-thumbnail">
                        </div>
                        <div class="similar-property-details">
                            <div class="similar-property-name">{{ $property->address }},
                                {{ Str::title($property->area->name) }},
                                {{ Str::title($property->county->name) }}, {{ $property->eircode }}</div>
                            <div class="d-flex justify-content-between">
                                <div class="similar-property-amount">{{ Config::get('settings.currency_symbol') }}
                                    {{ $property->price }}</div>
                                @if ($property->status == 0)
                                    <span class="badge text-bg-warning">In Review</span>
                                @elseif($property->status == 1)
                                    <span class="badge text-bg-success">Approved</span>
                                @elseif($property->status == 2)
                                    <span class="badge text-bg-danger">Rejected</span>
                                @elseif ($property->status == 3)
                                    <span class="badge text-bg-light">Expired</span>
                                @elseif ($property->status == 4)
                                    <span class="badge text-bg-secondary">Sold</span>
                                @elseif ($property->status == 5)
                                    <span class="badge text-bg-dark">Archived</span>
                                @endif
                            </div>
                            <div class="similar-property-features">
                                {{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}
                                Beds
                                |
                                {{ $property->bath_rooms }} Baths |
                                @if ($property->category->name == 'share')
                                    {{ Str::title($property->category->name) }}
                                @else
                                    {{ Str::title($property->category->name) }} {{ Str::title($property->adType->name) }}
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="similar-property-features"><i class="fas fa-eye"></i> {{ $property->views }}
                                </div>
                                <div>
                                    <a href="" class="text-secondary text-decoration-none me-2"><i
                                            class="fas fa-ban"></i></a>
                                    <a href="" class="text-dark text-decoration-none me-2"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="" class="text-danger text-decoration-none"><i
                                            class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="d-flex d-lg-flex justify-content-end">
                {{ $properties->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
