@extends('frontend.layout.master')
@section('title', 'Estate Agent Registration')
@section('content')
    <div class="container py-4" style="min-height: 600px;">
        <div style="margin: 0 auto;max-width: 600px;">
            {{-- Toast Message --}}
            @if (session('toast'))
                @if (session('toast.type') == 'success')
                    <x-bs5-toast type="{{ session('toast.type', 'success') }}" message="{{ session('toast.message') }}" />
                @else
                    <x-bs5-toast type="{{ session('toast.type', 'danger') }}" message="{{ session('toast.message') }}" />
                @endif
            @endif
            <form action="{{ route('agent.register', $invitation->token) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Estate Agent Registration</h2>
                <div class="card">
                    <div class="card-body">
                        <h5>Personal Details</h5>
                        <div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label" for="name">Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input class="shadow-none form-control" type="text" placeholder="Full Name"
                                        name="name" value="{{ old('name', $vendor->name) }}" readonly />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="email">Email <span
                                            class="text-danger">*</span></label>
                                    <input class="shadow-none form-control" type="text" placeholder="Email id"
                                        name="email" value="{{ old('email', $vendor->email) }}" readonly />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="phone">Phone <span
                                            class="text-danger">*</span></label>
                                    <input class="shadow-none form-control" type="text" placeholder="phone"
                                        name="phone" value="{{ old('phone', $vendor->phone) }}" readonly />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="profile_picture">Profile
                                        Picture</label>
                                    <input class="shadow-none form-control" type="file" name="profile_picture" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Compnay Details</h5>
                        <div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label" for="role">Role in Company <span
                                            class="text-danger">*</span></label>
                                    <select class="shadow-none form-select @error('role') is-invalid @enderror"
                                        name="role">
                                        <option value="owner" selected="">Owner</option>
                                        <option value="Agent">Co-owner</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="business_type">Business Type <span
                                            class="text-danger">*</span></label>
                                    <select
                                        class="form-select shadow-none @error('business_type') is-invalid
                                        
                                    @enderror"
                                        name="business_type">
                                        <option value="Individual">Individual</option>
                                        <option value="Company">Company</option>
                                    </select>
                                    @error('business_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12"><label class="form-label" for="company_name">Company Name/ Individual
                                        Name <span class="text-danger">*</span></label><input
                                        class="shadow-none form-control @error('company_name') is-invalid
                                            
                                        @enderror"
                                        type="text" placeholder="ABC Real Estate Ltd." name="company_name"
                                        value="{{ old('company_name') }}" />
                                    @error('company_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="psra_license_number">PSRA License
                                        Number <span class="text-danger">*</span></label>
                                    <input
                                        class="shadow-none form-control @error('psra_license_number') is-invalid @enderror"
                                        type="text" placeholder="PSRA License" name="psra_license_number" />
                                    @error('psra_license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6"><label class="form-label" for="license_expiry_date">License Expiry
                                        Date <span class="text-danger">*</span></label><input
                                        class="shadow-none form-control @error('license_expiry_date') is-invalid @enderror"
                                        name="license_expiry_date" type="date" />
                                    @error('license_expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6"><label class="form-label" for="vat_registration_number">VAT
                                        Number <span class="text-danger">*</span></label><input
                                        class="shadow-none form-control @error('vat_registration_number') is-invalid @enderror"
                                        type="text" placeholder="VAT Number" name="vat_registration_number" />
                                    @error('vat_registration_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6"><label class="form-label" for="company_registration_number">Company
                                        Registration Number <span class="text-danger">*</span></label><input
                                        class="shadow-none form-control @error('company_registration_number') is-invalid @enderror"
                                        type="text" placeholder="Company Registration"
                                        name="company_registration_number" />
                                    @error('company_registration_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="email">Business Email <span
                                            class="text-danger">*</span></label>
                                    <input
                                        class="shadow-none form-control @error('business_email') is-invalid
                                        
                                    @enderror"
                                        type="text" placeholder="Email id" name="business_email" />
                                    @error('business_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="phone">Business Phone <span
                                            class="text-danger">*</span></label>
                                    <input class="shadow-none form-control @error('business_phone') is-invalid @enderror"
                                        type="text" placeholder="Phone" name="business_phone" />
                                    @error('business_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="date_of_birth">Website</label>
                                    <input class="shadow-none form-control" type="text"
                                        placeholder="www.abcrealestate.ie" name="company_website" />
                                </div>
                                <div class="col-lg-6"><label class="form-label" for="company_logo">Company
                                        Logo</label>
                                    <input class="shadow-none form-control" type="file" name="company_logo" />
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label" for="description">About your
                                        company <span class="text-danger">*</span></label>
                                    <textarea class="shadow-none form-control @error('description') is-invalid @enderror"
                                        placeholder="Write someting about your agency" rows="10" name="description"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Company Address</h5>
                        <div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label" for="address">Address <span
                                            class="text-danger">*</span></label>
                                    <input class="shadow-none form-control @error('address') is-invalid @enderror"
                                        type="text" name="address" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="county">County <span
                                            class="text-danger">*</span></label>
                                    <select class="shadow-none form-select @error('county') is-invalid @enderror"
                                        name="county_id" id="county" required>
                                        <option value="">Select County</option>
                                        @foreach ($counties as $county)
                                            <option value="{{ $county->id }}">{{ Str::title($county->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('county')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="area_id">Area <span
                                            class="text-danger">*</span></label>
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
                                <div class="col-lg-6">
                                    <label class="form-label" for="eircode">Eircode <span
                                            class="text-danger">*</span></label>
                                    <input class="shadow-none form-control @error('eircode') is-invalid @enderror"
                                        type="text" placeholder="Eircode" name="eircode" />
                                    @error('eircode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="form-check custom-checkbox">
                        <input class="form-check-input shadow-none @error('terms_accepted') is-invalid @enderror"
                            type="checkbox" id="terms_accepted" name="terms_accepted" checked />
                        <label class="form-check-label" for="terms_accepted">Accept
                            <a href="https://eirehome.ie/page/terms-and-conditions">Terms &amp; Conditions</a>
                        </label>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="form-check custom-checkbox">
                        <input class="form-check-input shadow-none @error('gdpr_accepted') is-invalid @enderror"
                            type="checkbox" id="gdpr_accepted" name="gdpr_accepted" checked />
                        <label class="form-check-label" for="gdpr_accepted">Accept
                            <a href="https://eirehome.ie/page/privacy-policy">Privacy &amp; Policy</a>
                        </label>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="form-check custom-checkbox">
                        <input class="form-check-input shadow-none" type="checkbox" id="marketing_opt_in"
                            name="marketing_opt_in" />
                        <label class="form-check-label" for="marketing_opt_in">Marketing
                            Consent (optional for newsletters)</label>
                    </div>
                </div>
                <div class="my-3">
                    <button class="btn btn-primary link-light" type="submit">Submit for Verification</button>
                </div>
            </form>
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
