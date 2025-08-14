@extends('frontend.layout.master')
@section('title', 'Service Provider Registration')
@section('content')
    <div class="container py-5" style="min-height: 600px;">
        <div style="margin: 0 auto;max-width: 600px;">
            @error('slug')
                <x-alert type="danger" message="Property already exists. We do not allow duplicates." />
            @enderror

            {{-- Toast Message --}}
            @if (session('toast'))
                @if (session('toast.type') == 'success')
                    <x-bs5-toast type="{{ session('toast.type', 'success') }}" message="{{ session('toast.message') }}" />
                @else
                    <x-bs5-toast type="{{ session('toast.type', 'danger') }}" message="{{ session('toast.message') }}" />
                @endif
            @endif
            <div>
                <form action="{{ route('vendor.register.submit', $invitation->token) }}" method="POST">
                    @csrf
                    <div>
                        <h2>Service Provider Registration</h2>
                        <p>Enter registred address</p>
                        @if (!empty($counties))
                            <div class="mb-3">
                                <label class="form-label" for="county">County</label>
                                <select class="shadow-none form-select @error('county_id') is-invalid @enderror"
                                    name="county_id" id="county" required>
                                    <option value="">Select County</option>
                                    @foreach ($counties as $county)
                                        <option value="{{ $county->id }}">{{ Str::title($county->name) }}</option>
                                    @endforeach
                                </select>
                                @error('county_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label" for="area_id">Area</label>
                            <select
                                class="shadow-none form-select @error('area')
                                is-invalid
                            @enderror"
                                name="area_id" id="area" required>
                                <option value="">Select Area</option>
                            </select>
                            @error('area_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="eircode">Eircode </label>
                            <input
                                class="shadow-none form-control @error('eircode')
                                is-invalid
                            @enderror"
                                type="text" name="eircode" id="eircode" value="{{ old('eircode') }}" required
                                autocomplete="off">
                            @error('eircode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input
                                class="shadow-none form-control @error('address') is-invalid
                            @enderror"
                                type="text" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <div class="row">
                                <div class="col">
                                    <input class="shadow-none form-control" type="hidden" name="latitude" id="latitude"
                                        placeholder="5.2365226" readonly required>
                                </div>
                                <div class="col">
                                    <input class="shadow-none form-control" type="hidden" name="longitude" id="longitude"
                                        placeholder="-6.26522144" readonly required>
                                </div>
                            </div>
                        </div>
                        <h2>Company Details</h2>
                        <div class="mb-3">
                            <label class="form-label" for="vendor_name">Company Name</label>
                            <input class="shadow-none form-control @error('vendor_name') is-invalid @enderror"
                                type="text" id="vendor_name" name="vendor_name" value="{{ old('vendor_name') }}"
                                required>
                            @error('vendor_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="vat_number">VAT Number (Optional)</label>
                            <input class="shadow-none form-control @error('vat_number') is-invalid @enderror" type="text"
                                id="vat_number" name="vat_number" value="{{ old('vat_number') }}">
                            @error('vat_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h2>Contact Details</h2>
                        <div class="mb-3">
                            <label class="form-label" for="name">Authorised Name</label>
                            <input class="shadow-none form-control" type="text" id="name" name="name"
                                value="{{ old('name', $invitation->name) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="shadow-none form-control" type="text" id="email" name="email"
                                value="{{ old('email', $invitation->email) }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="shadow-none form-control" type="password" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input class="shadow-none form-control" type="text" id="phone" name="phone"
                                value="{{ old('phone', $invitation->phone) }}" readonly>
                            <div class="mt-2">
                                <div class="form-switch">
                                    <input type="checkbox" id="show_ph" name="show_ph"
                                        class="form-check-input shadow-none">
                                    <label class="form-check-label ms-2" for="show_ph">Show Phone Number to
                                        Viewers</label>
                                </div>
                            </div>
                        </div>
                        <h2>Description</h2>
                        <div class="mb-3">
                            <label class="form-label" for="description">Write About Company</label>
                            <textarea class="shadow-none form-control @error('description') is-invalid

                            @enderror"
                                id="description" name="description" rows="10" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="error-message" class="text-danger"></small>
                        </div>
                        <p>By submitting this form, you agree to our <a href="#">Terms &amp; Conditions</a>&nbsp,<a
                                href="#">Equality
                                guidelines</a></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary link-light shadow-none" type="submit">Submit</button>
                        </div>
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

        // Area Fetch By County
        $(document).ready(function() {
            $("#county").change(function() {
                var county_id = $(this).val();

                if (county_id == "") {
                    var county_id = 0;
                }
                //alert(country_id);
                $.ajax({
                    url: '{{ url('/fetch-area/') }}/' + county_id,
                    type: 'post',
                    dataType: 'json',
                    success: function(response) {
                        $('#area').find('option:not(:first)').remove();
                        if (response['area'].length > 0) {
                            $.each(response['area'], function(key, value) {
                                $("#area").append("<option value='" + value['id'] +
                                    "'>" + capitalizeFirstLetter(value['name']) +
                                    "</option>"
                                )
                            });
                        }
                    }
                });
            });
        })

        // Capitalize First Letter
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Eircode Coordinates
        $(document).ready(function() {
            $("#eircode").change(function() {
                var eircode = $(this).val();
                $.ajax({
                    url: "/get-coordinates",
                    type: "GET",
                    data: {
                        eircode: eircode
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            $('#latitude').val(response.lat);
                            $('#longitude').val(response.lng);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        console.log("Error fetching data.")
                    }
                });
            });
        })

        // Restricted Words
        $(document).ready(function() {
            const restrictedWords = [
                // 🚫 Housing Assistance Discrimination
                "no social welfare", "no housing assistance", "no HAP", "HAP not accepted",
                "rent allowance not accepted", "no government assistance", "no rent supplement",
                "no benefits", "no unemployed", "working professionals only", "must be employed",

                // 🚫 Gender Discrimination
                "male only", "female only", "no men", "no women", "boys only", "girls only",
                "no single men", "no single women", "ladies only", "gentlemen only",
                "ideal for bachelors", "perfect for a single lady", "no mixed genders",

                // 🚫 Civil & Family Status Discrimination
                "single only", "married only", "divorced only", "widow", "widower",
                "no single parents", "no families", "family-friendly", "ideal for newlyweds",
                "perfect for young couples", "suitable for single professionals",

                // 🚫 Sexual Orientation Discrimination
                "gay", "lesbian", "straight", "bisexual", "heterosexual", "homosexual",
                "non-binary", "LGBTQ friendly", "LGBTQ only", "no LGBTQ", "no same-sex couples",
                "must be heterosexual", "traditional family only", "no rainbow tenants",

                // 🚫 Religion Discrimination
                "Christian only", "Muslim only", "Hindu only", "Jewish only", "Catholic only",
                "no atheists", "born again", "church-going", "practicing faith required",
                "must be religious", "no non-believers", "faith-based tenants preferred",
                "no Muslims", "no Hindus", "no Christians", "no Jews",

                // 🚫 Age Discrimination
                "young professionals only", "no seniors", "elderly not allowed", "ideal for young people",
                "middle-aged only", "students preferred", "not suitable for retirees",
                "perfect for millennials", "ideal for Gen Z", "must be under 30",
                "too old", "too young", "retired only", "no under 25s", "no over 40s",

                // 🚫 Disability Discrimination
                "no wheelchair access", "not suitable for disabled", "no guide dogs",
                "must be able-bodied", "no special accommodations", "not accessible",
                "stairs only", "no lifts available", "physical fitness required",
                "no disabled tenants", "not for those with mobility issues",

                // 🚫 Race & Ethnicity Discrimination
                "white only", "black only", "no Asians", "Irish only", "no foreigners",
                "no immigrants", "preferred race", "no ethnic minorities", "no people of color",
                "non-Irish need not apply", "no refugees", "English speakers only",
                "no non-native speakers", "no people from India", "no African tenants",
                "no Eastern Europeans", "must be native Irish",

                // 🚫 Traveller Community Discrimination
                "no Travellers", "not suitable for Travellers", "settled community only",
                "long-term residents only", "no transient tenants", "no caravan dwellers",
                "permanent residents only", "no nomads", "local families preferred",

                // 🚫 Offensive or Exclusionary Phrases
                "no pets", "no children", "quiet tenants only", "must be quiet",
                "no parties", "no loud people", "no visitors allowed", "no overnight guests",
                "no drinking", "must be sober", "must follow house rules",

                // 🚫 Unfair Preference Statements
                "ideal for working professionals", "no weekend stays", "perfect for a young single",
                "mature tenants only", "no newcomers", "long-time residents only",
                "not for students", "no night shift workers", "only certain backgrounds",
                "must have perfect credit", "no DSS", "must provide references from last 3 landlords",

                // 🚫 Other Discriminatory & Problematic Words
                "ethnic background", "cultural fit", "family-oriented community",
                "Christian values", "not suitable for certain lifestyles",
                "must have traditional values", "exclusive area", "upscale tenants only",
                "not for first-time renters", "only high-income tenants",
                "must speak fluent English", "integrated community only"
            ];


            $(document).ready(function() {
                $("#description").on("input", function() {
                    let inputValue = $(this).val().toLowerCase();
                    let words = inputValue.trim().split(/\s+/); // Count words
                    let foundWords = [];

                    // Convert input text into an array of words (removes punctuation)
                    let inputWords = inputValue.replace(/[^\w\s]/g, "").split(/\s+/);

                    // Check for restricted words (exact match only)
                    restrictedWords.forEach(word => {
                        if (inputWords.includes(word)) {
                            foundWords.push(word);
                        }
                    });

                    // Validation messages
                    if (words.length < 50) {
                        $("#error-message").text(
                            "Your description must contain at least 50 words.");
                        $("#next-btn").prop("disabled", true);
                    } else if (foundWords.length > 0) {
                        $("#error-message").text("Your description contains restricted words");
                        $("#next-btn").prop("disabled", true);
                    } else {
                        $("#error-message").text(""); // Remove error message
                        $("#next-btn").prop("disabled", false); // Enable submit button
                    }
                });
            });
        });
    </script>
@endsection
@endsection
