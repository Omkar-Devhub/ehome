<div>
    <ul class="nav nav-tabs justify-content-center" id="propertyTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="buy-tab" data-bs-toggle="tab" data-bs-target="#buy" type="button"
                role="tab" aria-controls="buy" aria-selected="false">
                Buy
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rent-tab" data-bs-toggle="tab" data-bs-target="#rent" type="button"
                role="tab" aria-controls="rent" aria-selected="false">
                Rent
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="share-tab" data-bs-toggle="tab" data-bs-target="#share" type="button"
                role="tab" aria-controls="share" aria-selected="true">
                Share
            </button>
        </li>
    </ul>

    <div class="tab-content search-form" id="propertyTabsContent">

        <!-- Buy Tab -->
        <div class="tab-pane fade show active" id="buy" role="tabpanel" aria-labelledby="buy-tab">
            <form action="{{ route('property.search') }}" method="GET">
                <div class="form-row">
                    <input type="hidden" name="ad_type_id" value="2">
                    @if (!empty($counties))
                        <select class="shadow-none form-select @error('county_id') is-invalid @enderror"
                            name="county_id" id="county" required>
                            <option value="">Select County</option>
                            @foreach ($counties as $county)
                                <option value="{{ $county->id }}">{{ Str::title($county->name) }}</option>
                            @endforeach
                        </select>
                    @endif
                    <select
                        class="shadow-none form-select @error('area')
                                is-invalid
                            @enderror"
                        name="area_id" id="area" required>
                        <option value="">Select Area</option>
                    </select>
                    <button type="submit" class="btn btn-primary link-light shadow-none">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Rent Tab -->
        <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
            <form action="{{ route('property.search') }}" method="GET">
                <div class="form-row">
                    <input type="hidden" name="ad_type_id" value="1">
                    @if (!empty($counties))
                        <select class="shadow-none form-select @error('county_id') is-invalid @enderror"
                            name="county_id" id="county" required>
                            <option value="">Select County</option>
                            @foreach ($counties as $county)
                                <option value="{{ $county->id }}">{{ Str::title($county->name) }}</option>
                            @endforeach
                        </select>
                    @endif
                    <select
                        class="shadow-none form-select @error('area')
                                is-invalid
                            @enderror"
                        name="area_id" id="area" required>
                        <option value="">Select Area</option>
                    </select>
                    <button type="submit" class="btn btn-primary link-light shadow-none">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Sale Tab -->
        <div class="tab-pane fade" id="share" role="tabpanel" aria-labelledby="share-tab">
            <form action="{{ route('property.search') }}" method="GET">
                <div class="form-row">
                    <input type="hidden" name="ad_type_id" value="3">
                    @if (!empty($counties))
                        <select class="shadow-none form-select @error('county_id') is-invalid @enderror"
                            name="county_id" id="county" required>
                            <option value="">Select County</option>
                            @foreach ($counties as $county)
                                <option value="{{ $county->id }}">{{ Str::title($county->name) }}</option>
                            @endforeach
                        </select>
                    @endif
                    <select
                        class="shadow-none form-select @error('area')
                                is-invalid
                            @enderror"
                        name="area_id" id="area" required>
                        <option value="">Select Area</option>
                    </select>
                    <button type="submit" class="btn btn-primary link-light shadow-none">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('script')
    <script>
        // Ajax Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(".nav-link").on('click', function() {
                setTimeout(function() {
                    $("#county").change(); // Trigger county change when switching tabs
                }, 100);
            });

            // Area Fetch By County
            $(document).on("change", "#county", function() {
                var county_id = $(this).val();
                var tab = $(this).closest('.tab-pane');

                if (county_id == "") {
                    county_id = 0;
                }

                $.ajax({
                    url: '{{ url('/fetch-area/') }}/' + county_id,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        var areaSelect = tab.find("#area");
                        areaSelect.find('option:not(:first)').remove();

                        if (response['area'].length > 0) {
                            $.each(response['area'], function(key, value) {
                                areaSelect.append("<option value='" + value['id'] +
                                    "'>" + capitalizeFirstLetter(value['name']) +
                                    "</option>"
                                );
                            });
                        }
                    }
                });
            });

            // Trigger change event when a new tab is clicked
            $("#county").change();
        });

        // Capitalize First Letter
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
@endsection
