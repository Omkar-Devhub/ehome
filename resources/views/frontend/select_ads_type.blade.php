@extends('frontend.layout.master')
@section('title', 'Select Ads Type')
@section('content')
    <div class="container my-5" style="max-width: 800px; min-height: calc(-400px + 100vh)">
        <h2>Select your ad type</h2>
        <!-- Sub-heading -->
        <p>Choose the category that best fits your property listing.</p>
        <div class="row row-cols-2 row-cols-md-3 g-3 my-4">
            <!-- 2 cards per row on mobile, 3 on larger screens -->
            <!-- Residential - For Rent -->
            <div class="col-12 col-lg-4 col-md-12">
                <a href="{{ route('user.residential.rent.ads') }}" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Residential - For Rent</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List residential properties for rent.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="{{ route('user.residential.sale.ads') }}" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Residential - For Sale</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List residential properties for sale.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="{{ route('user.residential.share.ads') }}" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Residential - To Share</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List shared living spaces for rent.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="{{ route('user.commercial.rent.ads') }}" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Commercial - For Rent</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List commercial properties for rent.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="{{ route('user.commercial.sale.ads') }}" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Commercial - For Sale</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List commercial properties for sale.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Parking Space</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List parking spaces for rent or sale.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Sites</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List land for development/sale/rent.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-4 col-md-12">
                <a href="" class="text-decoration-none">
                    <div class="card" style="border: 1px solid #38b66c; background-color: #e2fcec">
                        <div class="card-body text-center">
                            <h5 style="font-size: 16px">Holiday Homes</h5>
                            <p style="font-size: 12px; margin-bottom: 0">
                                List vacation properties for rent or sale.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@section('script')
    <script>
        document
            .getElementById("profile_picture")
            .addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("preview_profile_picture").src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
@endsection
@endsection
