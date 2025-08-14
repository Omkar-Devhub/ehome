@extends('frontend.layout.master')
@section('title', 'My Favorites')
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

            <h2>My Favorite Properties</h2>
            <p class="mb-3" style="font-size: 0.8rem;">
                You have {{ $favorites->total() }} favorite {{ Str::plural('property', $favorites->total()) }}.
            </p>

            @if ($favorites->count() > 0)
                @foreach ($favorites as $property)
                    <div class="similar-property-card">
                        <div>
                            <img src="{{ asset($property->firstImage->image ?? 'placeholder.png') }}"
                                alt="Property Thumbnail" class="similar-property-thumbnail">
                        </div>
                        <div class="similar-property-details">
                            <div class="similar-property-name">
                                <a href="{{ route('property.show', ['type' => $property->adType->name, 'slug' => $property->slug]) }}"
                                    class="text-decoration-none text-dark">
                                    {{ $property->address }},
                                    {{ Str::title($property->area->name) }},
                                    {{ Str::title($property->county->name) }}, {{ $property->eircode }}
                                </a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="similar-property-amount">
                                    {{ Config::get('settings.currency_symbol') }}{{ number_format($property->price, 2) }}
                                </div>
                                <button class="btn btn-sm btn-outline-danger remove-favorite"
                                    data-property-id="{{ $property->id }}">
                                    <i class="fas fa-heart"></i> Remove
                                </button>
                            </div>
                            <div class="similar-property-features">
                                @if (
                                    $property->single_bedrooms != '' &&
                                        $property->double_bedrooms != '' &&
                                        $property->twin_bedrooms != '' &&
                                        $property->bath_rooms != '')
                                    {{ $property->single_bedrooms + $property->double_bedrooms + $property->twin_bedrooms }}
                                    Beds |
                                    {{ $property->bath_rooms }} Baths |
                                @endif
                                @if ($property->category->name == 'share')
                                    {{ Str::title($property->category->name) }}
                                @else
                                    {{ Str::title($property->category->name) }} {{ Str::title($property->adType->name) }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex d-lg-flex justify-content-end mt-4">
                    {{ $favorites->links('vendor.pagination.custom') }}
                </div>
            @else
                <div class="alert alert-light mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    You haven't saved any properties to your favorites yet.
                    <a href="{{ route('properties.index', ['adType' => 'rent']) }}" class="alert-link">Browse
                        properties</a> to add some.
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Remove from favorites
            $('.remove-favorite').click(function(e) {
                e.preventDefault();
                const propertyId = $(this).data('property-id');
                const card = $(this).closest('.similar-property-card');

                $.ajax({
                    url: '{{ route('property.toggle-favorite') }}',
                    type: 'POST',
                    data: {
                        property_id: propertyId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'removed') {
                            card.fadeOut(300, function() {
                                $(this).remove();

                                // Update favorites count in navbar
                                $('.favorites-count').text(response.favorites_count);

                                // Update the count text
                                const countText = response.favorites_count === 1 ?
                                    'You have 1 favorite property.' :
                                    `You have ${response.favorites_count} favorite properties.`;
                                $('.container.my-4 .mb-3').text(countText);

                                // Check if this was the last favorite
                                if (response.favorites_count === 0) {
                                    // Replace content with empty state
                                    $('.container.my-4').html(`
                                <div class="mt-2" style="min-height: 600px;max-width: 600px;margin: 0 auto;">
                                    <h2>My Favorite Properties</h2>
                                    <p class="mb-3" style="font-size: 0.8rem;">You have 0 favorite properties.</p>
                                    <div class="alert alert-light mt-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        You haven't saved any properties to your favorites yet.
                                        <a href="{{ route('properties.index', ['adType' => 'rent']) }}" class="alert-link">Browse properties</a> to add some.
                                    </div>
                                </div>
                            `);
                                }
                            });
                            toastr.success('Removed from favorites!');
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
