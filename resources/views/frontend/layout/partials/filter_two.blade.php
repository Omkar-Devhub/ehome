<div id="filter-section">
    <h4>Filter Property</h4>
    <form id="propertyFilterForm" action="{{ route('properties.county', $county) }}" method="GET">
        <div class="mb-2">
            <select class="shadow-none form-select area-dropdown" name="area_id">
                <option value="">Select Area</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                        {{ Str::title($area->name) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <select class="shadow-none form-select" name="property_type_id">
                <option value="">Property Type</option>
                @foreach ($propertyTypes as $propertyType)
                    <option value="{{ $propertyType->id }}"
                        {{ request('property_type_id') == $propertyType->id ? 'selected' : '' }}>
                        {{ Str::title($propertyType->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Bedrooms & Bathrooms</label>
            <div class="row">
                <div class="col">
                    <select class="shadow-none form-select" name="bed_rooms">
                        <option value="">Select Bedrooms</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ request('bed_rooms') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col">
                    <select class="shadow-none form-select" name="bath_rooms">
                        <option value="">Select Bathrooms</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ request('bath_rooms') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label class="form-label">Price range</label>
            <div class="row">
                <div class="col">
                    <input type="number" class="shadow-none form-control" name="min_price" placeholder="€200"
                        value="{{ request('min_price') }}">
                </div>
                <div class="col">
                    <input type="number" class="shadow-none form-control" name="max_price" placeholder="€1000000"
                        value="{{ request('max_price') }}">
                </div>
            </div>
        </div>
        <div class="mb-2">
            <select class="shadow-none form-select" name="furnished">
                <option value="">Any Furnish</option>
                <option value="furnished">Furnished</option>
                <option value="un_furnished">Un Furnished</option>
            </select>
        </div>
        <div>
            <p class="mb-0">Property Facilities</p>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($facilities as $facility)
                    <label class="facility-card border rounded p-2">
                        <input type="checkbox" name="facilities[]" value="{{ $facility->name }}" class="d-none"
                            {{ in_array($facility->name, request('facilities', [])) ? 'checked' : '' }}>
                        <span class="text-center">{{ ucfirst($facility->name) }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="my-3">
            <button class="btn btn-primary link-light" type="submit">Show Result</button>
        </div>
    </form>
</div>
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        document.getElementById('propertyFilterForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const form = event.target;
            const formData = new FormData(form);
            const queryParams = new URLSearchParams();

            // Loop through form data and add only non-empty values to the query parameters
            for (const [key, value] of formData.entries()) {
                if (value) {
                    if (key === 'facilities[]') {
                        // Handle facilities array separately
                        const facilities = formData.getAll('facilities[]');
                        facilities.forEach(facility => queryParams.append('facilities[]', facility));
                    } else {
                        queryParams.append(key, value);
                    }
                }
            }

            // Build the URL with query parameters
            const url =
                "{{ route('properties.county', $county) }}" +
                '?' + queryParams.toString();
            window.location.href = url; // Redirect to the filtered URL
        });
    </script>
@endsection
