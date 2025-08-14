@extends('frontend.agent.layout.master')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container my-3">
        <div class="p-4 d-flex align-items-center justify-content-between flex-wrap">

            <!-- Left: Heading -->
            <div class="flex-grow-1 mb-3 mb-md-0">
                <h4 class="fw-bold mb-0">Agent Dashboard</h4>
            </div>

            <!-- Center: Agent Logo -->
            <div class="text-center mb-3 mb-md-0 me-2">
                <img src="https://placehold.co/80" style="width: 80px; height: 80px; object-fit: cover;" />
            </div>

            <!-- Right: Agent Details -->
            <div class="text-right">
                <p class="mb-1"><strong>ABC Real Estate Ltd.</strong></p>
                <p class="mb-1"><strong>Phone:</strong> +353 123 456 789</p>
                <p class="mb-0"><strong>Email:</strong> info@abcrealestate.ie</p>
            </div>

        </div>
        <!-- Dashboard Widgets Section with Subtle Borders -->
        <div class="col-12 mb-3">
            <div class="row g-3">

                <!-- Today's Inquiries -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 shadow-sm" style="background-color: #f0f8ff; border-left: 4px solid #0d6efd;">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-question-circle fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-size: 14px;">Today's Inquiries</h6>
                                <h5 class="mb-0 fw-bold">12</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Listings -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 shadow-sm" style="background-color: #e9f7ef; border-left: 4px solid #198754;">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-size: 14px;">Active Listings</h6>
                                <h5 class="mb-0 fw-bold">28</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expired Listings -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 shadow-sm" style="background-color: #fdecea; border-left: 4px solid #dc3545;">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-size: 14px;">Expired Listings</h6>
                                <h5 class="mb-0 fw-bold">4</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending for Reviews -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 shadow-sm" style="background-color: #fff3cd; border-left: 4px solid #ffc107;">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" style="font-size: 14px;">Pending for Reviews</h6>
                                <h5 class="mb-0 fw-bold">6</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="mb-3 p-3 border rounded shadow-sm" style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0 text-primary">Subscription Package</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <p class="mb-1"><strong>Package:</strong> Standard Listing</p>
                            <p class="mb-1"><strong>End Date:</strong> 31 May 2025</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Quota Usage:</strong></p>
                            <p class="mb-0">Used: <strong>12</strong> / Total: <strong>20</strong> Listings</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3 p-3 border rounded shadow-sm" style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0 text-primary">Account Manager</h5>
                        <a class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                            href="#">Raise a Ticket</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-1"><strong>Name:</strong> Jhon Doe</p>
                            <p class="mb-1"><strong>Email:</strong> jhonedoe@eirehome.ie</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100" style="border: 1px solid #38b66c; background-color: #e2fcec">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-line fa-2x text-primary mb-2"></i>
                                <h5 style="font-size: 16px">Business Intelligence</h5>
                                <p style="font-size: 12px; margin-bottom: 0">Gain insight into market trends.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100"
                        style="border: 1px solid #ccc; background-color: #f8f9fa; pointer-events: none; opacity: 0.6">
                        <div class="card-body text-center">
                            <i class="fas fa-calculator fa-2x text-primary mb-2"></i>
                            <h5 style="font-size: 16px">Property Valuation</h5>
                            <p style="font-size: 12px; margin-bottom: 0">Evaluate property worth easily.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="#" class="text-decoration-none">
                        <div class="card h-100" style="border: 1px solid #38b66c; background-color: #e2fcec">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope-open-text fa-2x text-primary mb-2"></i>
                                <h5 style="font-size: 16px">Leads Center</h5>
                                <p style="font-size: 12px; margin-bottom: 0">Manage your leads efficiently.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Activity Log</h5>
            </div>
            <div class="card-body" style="height: 30vh;">
                <p class="card-text">No Activity Found</p>
            </div>
        </div>
    </div>
@endsection
