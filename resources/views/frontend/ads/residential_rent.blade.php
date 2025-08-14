@extends('frontend.layout.master')
@section('title', 'Select Ads Type')
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
                <form id="multiStepForm" action="{{ route('user.residential.rent.ads.store') }}" method="POST">
                    @csrf
                    <div class="step active" id="step1">
                        <h2>Location</h2>
                        <p>Enter address manually&nbsp;</p>
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
                                type="text" name="eircode" id="eircode" value="{{ old('eircode') }}" required>
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
                        <div class="mb-4">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="latitude">Latitude</label>
                                    <input class="shadow-none form-control" type="text" name="latitude" id="latitude"
                                        placeholder="5.2365226" readonly required>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="longitude">Longitude</label>
                                    <input class="shadow-none form-control" type="text" name="longitude" id="longitude"
                                        placeholder="-6.26522144" readonly required>
                                </div>
                                <input type="hidden" name="slug" id="slug">
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-outline-dark shadow-none next-step" type="button">Next</button>
                        </div>
                    </div>
                    <div class="step" id="step2">
                        <h2>Property Details</h2>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="price">Price
                                        {{ Config()->get('settings.currency_symbol') }}</label>
                                    <input
                                        class="shadow-none form-control @error('price') is-invalid

                                    @enderror"
                                        type="number" name="price" value="{{ old('price') }}" id="price" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="rent_type">Rent Type</label>
                                    <select
                                        class="shadow-none form-select @error('rent_type')
                                        is-invalid
                                    @enderror"
                                        id="rent_type" name="rent_type" required>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                    @error('rent_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($property_types->count() > 0)
                            <div class="mb-3">
                                <label class="form-label" for="property_type">Property Type</label>
                                <select
                                    class="shadow-none form-select @error('property_type')
                                is-invalid
                            @enderror"
                                    name="property_type" id="property_type" required>
                                    <option value="">Select Property Type</option>
                                    @foreach ($property_types as $property_type)
                                        <option value="{{ $property_type->id }}">{{ Str::title($property_type->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="available_from">Available from</label>
                                    <input class="shadow-none form-control @error('available_from') is-invalid @enderror"
                                        id="available_from" name="available_from" type="date" required>
                                    @error('available_from')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="lease">Lease (Optional)</label>
                                    <select class="shadow-none form-select" name="lease" id="lease">
                                        <option value="">Select Lease</option>
                                        <option value="3 months">3 months</option>
                                        <option value="6 months">6 months</option>
                                        <option value="9 months">9 months</option>
                                        <option value="1 year">1 year</option>
                                        <option value="2 years">2 years</option>
                                        <option value="3 years">3 years</option>
                                        <option value="5 years">5 years</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="single_bedrooms">Single Bedrooms</label>
                                    <select class="shadow-none form-select" name="single_bedrooms" id="single_bedrooms"
                                        required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="double_bedrooms">Double Bedrooms</label>
                                    <select class="shadow-none form-select" name="double_bedrooms" id="double_bedrooms">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="twin_bedrooms">Rwin Bedrooms</label>
                                    <select class="shadow-none form-select" name="twin_bedrooms" id="twin_bedrooms">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="bath_rooms">Bath rooms</label>
                                    <select class="shadow-none form-select" name="bath_rooms" id="bath_rooms" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                @if (!empty($bers))
                                    <div class="col">
                                        <label class="form-label" for="ber">BER</label>
                                        <select class="shadow-none form-select @error('ber') is-invalid @enderror"
                                            name="ber" id="ber">
                                            <option value="">Select Ber</option>
                                            @foreach ($bers as $ber)
                                                <option value="{{ $ber->id }}">{{ $ber->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('ber')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <div class="col">
                                    <label class="form-label" for="ber_no">BER No. <span
                                            style="color: rgb(128, 128, 128);">(Optional)</span></label>
                                    <input class="shadow-none form-control" type="text" name="ber_no"
                                        id="ber_no">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="property_size">Property Size</label>
                                    <input
                                        class="shadow-none form-control @error('property_size') is-invalid
                                    @enderror"
                                        type="number" name="property_size" value="{{ old('property_size') }}"
                                        id="property_size">
                                    @error('property_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label" for="units">Units</label>
                                    <select
                                        class="shadow-none form-select @error('units')
                                        is-invalid
                                    @enderror"
                                        id="units" name="units">
                                        <option value="sq ft">Square Feet</option>
                                        <option value="sq m">Square Meters</option>
                                    </select>
                                    @error('units')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-light prev-step" type="button">Previous</button>
                            <button class="btn btn-outline-dark shadow-none next-step" type="button">Next</button>
                        </div>
                    </div>
                    <div class="step" id="step3">
                        <h2>Facilities</h2>
                        <div class="mb-3">
                            <label class="form-label" for="furnishing_status">Furnishing</label>
                            <select
                                class="shadow-none form-select @error('furnishing_status')
                                is-invalid
                                @enderror"
                                name="furnishing_status" id="furnishing_status">
                                <option value="">Furnishing Type</option>
                                <option value="furnished">Furnished</option>
                                <option value="unfurnished">Unfurnished</option>
                                <option value="either">Either Available</option>
                            </select>
                            @error('furnishing_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (!empty($facilities))
                            <div class="mb-3">
                                <label class="form-label" for="facility">Select Facilities</label>
                                <select class="shadow-none form-select select_facility" id="facility" name="facility[]"
                                    multiple="multiple" style="width: 100% !important;">
                                    @foreach ($facilities as $facility)
                                        <option value="{{ $facility->name }}">{{ $facility->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mb-4">
                            <label class="form-label" for="near_by">Near By</label>
                            <table class="table table-bordered" id="table">
                                <tr>
                                    <th>Place</th>
                                    <th>Distance</th>
                                    <th>Action</th>
                                </tr>
                                <tbody id="tbody">
                                    <tr>
                                        <td><input class="shadow-none form-control" type="text" name="location[]"
                                                placeholder="Govt. Hospital"></td>
                                        <td><input class="shadow-none form-control" type="text" name="distance[]"
                                                placeholder="1km"></td>
                                        <td><button class="btn btn-primary text-light shadow-none" id="add"
                                                type="button">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-light prev-step" type="button">Previous</button>
                            <button class="btn btn-outline-dark shadow-none next-step" type="button">Next</button>
                        </div>
                    </div>
                    <div class="step" id="step4">
                        <h2>Description</h2>
                        <div class="mb-4">
                            <label class="form-label" for="description">Write Description</label>
                            <textarea class="shadow-none form-control @error('description') is-invalid

                            @enderror"
                                id="property_description" name="description" rows="10" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="error-message" class="text-danger"></small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-light prev-step" type="button">Previous</button>
                            <button class="btn btn-dark shadow-none next-step" id="next-btn"
                                type="button">Next</button>
                        </div>
                    </div>
                    <div class="step" id="step5">
                        <h2>Upload Images</h2>
                        <div class="mb-4">
                            {{-- <div class="file-upload-container">
                                <p>Drag &amp; Drop files here or click to select files</p>
                            </div> --}}
                            <div id="dropzone" class="dropzone file-upload-container"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-light prev-step" type="button">Previous</button>
                            <button class="btn btn-dark shadow-none next-step" type="button">Next</button>
                        </div>
                    </div>
                    <div class="step" id="step6">
                        <h2>Contact Details</h2>
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input class="shadow-none form-control" type="text" id="name" name="name"
                                value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="shadow-none form-control" type="text" id="email" name="email"
                                value="{{ Auth::user()->email }}" readonly>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="address-1">Phone</label>
                            <input class="shadow-none form-control" type="text" id="phone" name="phone"
                                value="{{ Auth::user()->phone }}" readonly>
                            <div class="mt-2">
                                <div class="form-switch">
                                    <input type="checkbox" id="show_ph" name="show_ph"
                                        class="form-check-input shadow-none">
                                    <label class="form-check-label ms-2" for="show_ph">Show Phone Number to
                                        Viewers</label>
                                </div>
                            </div>
                        </div>
                        <p>By submitting this form, you agree to our <a href="#">Terms &amp; Conditions</a>&nbsp,<a
                                href="#">Equality
                                guidelines</a></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-light prev-step" type="button">Previous</button>
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

        // Nearby Places
        $('#add').click(function() {
            $('#tbody').append(`
            <tr>
                <td><input class="shadow-none form-control" type="text" name="location[]"
                        placeholder="Govt. Hospital"></td>
                <td><input class="shadow-none form-control" type="text" name="distance[]"
                        placeholder="1km"></td>
                <td><button class="btn btn-danger text-light shadow-none remove" id="remove"
                        type="button">-</button>
                </td>
            </tr>
            `);
        })

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
        })

        //Description Editor Initialization
        // var editor = new Jodit('#property_description');

        // date picker
        document.getElementById('available_from').min = new Date().toISOString().split('T')[0];

        // slug generation
        $('#address').change(function() {
            county = $('#county option:selected').text().toLowerCase();
            area = $('#area option:selected').text().toLowerCase();
            eircode = $('#eircode').val();
            address = $('#address').val();
            $.ajax({
                url: "{{ route('get.slug.guest') }}",
                type: "get",
                data: {
                    title: address + '-' + area + '-' + county + '-' + eircode
                },
                dataType: "json",
                success: function(response) {
                    if (response['status'] == 'success') {
                        $('#slug').val(response['slug']);
                        console.log(response['slug']);
                    }
                }
            });
        });


        // Multi-Step Form 2
        $(document).ready(function() {
            let currentStep = 1;

            function showStep(step) {
                $(".step").removeClass("active");
                $(`#step${step}`).addClass("active");
            }

            function validateStep(step) {
                let isValid = true;
                $(`#step${step} .form-control, #step${step} .form-select, #step${step} textarea`).each(function() {
                    // Skip validation for optional fields
                    if (!$(this).prop("required")) {
                        return true; // Continue to the next field
                    }
                    // Validate mandatory fields
                    if ($(this).is('select')) {
                        // For <select>, check if a valid option is selected
                        if ($(this).val() === "") {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    } else if (!$(this).val()) {
                        // For input fields and <textarea>, check if the value is empty
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return isValid;
            }

            $(".next-step").click(function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            $(".prev-step").click(function() {
                currentStep--;
                showStep(currentStep);
            });
        });

        // Dropzone Initialization
        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone("#dropzone", {
            url: "{{ route('ads.uploadImages') }}",
            paramName: "file", // The name of the file input field
            maxFilesize: 2, // MB
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                // Store uploaded image paths
                file.previewElement.dataset.imagePath = response.file_path;
            },
            removedfile: function(file) {
                // Handle file removal if needed
                file.previewElement.remove();
            }
        });

        // Collect image paths on form submission
        document.querySelector("#multiStepForm").addEventListener("submit", function(e) {
            const uploadedFiles = [];
            document.querySelectorAll("#dropzone .dz-preview").forEach(preview => {
                uploadedFiles.push(preview.dataset.imagePath);
            });
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "uploaded_images";
            hiddenInput.value = JSON.stringify(uploadedFiles);
            this.appendChild(hiddenInput);
        });


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
                $("#property_description").on("input", function() {
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
