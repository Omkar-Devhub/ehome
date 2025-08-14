@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>Settings</h1>
                    <a href="#" class="btn btn-dark">Button</a>
                </div>
            </div> --}}
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            {{-- Toast Message --}}
            @if (session('toast'))
                @if (session('toast.type') == 'success')
                    <x-toast :message="session('toast.message')" :type="session('toast.type', 'success')" />
                @else
                    <x-toast :message="session('toast.message')" :type="session('toast.type', 'danger')" />
                @endif
            @endif
            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Website Settings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-cog text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.general-section.edit') }}">General</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update your general settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.email-settings.edit') }}">Email</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update your email settings and
                                            email templates
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-file-invoice text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="#">Invoice</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update invoice settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-address-card text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.contact-settings.edit') }}">Contact</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update contact settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-chart-bar text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="#">Analytics</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update analytics settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-icons text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.social-media') }}">Social Media</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update social media settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-cookie-bite text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.cookies-section.edit') }}">Cookies Alert</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update cookies alert settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-spider text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.seo-section.edit') }}">SEO Settings</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update SEO settings
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-tools text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.maintenance-section.edit') }}">Maintenance
                                            Mode</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update Maintenance Mode
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Home Page Settings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-images text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.hero-section.edit') }}">Hero Section</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update your hero section
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-digital-tachograph text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.feature-property-section.edit') }}">Featured
                                            Property</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update your featured property
                                            section
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="d-flex align-items-start p-2">
                                    <div class="rounded" style="background: #f1f1f1; padding: 8px 12px;">
                                        <i class="fas fa-map-marker text-muted"></i>
                                    </div>
                                    <div>
                                        <a class="font-weight-normal text-dark ml-3 text-decoration-none font-weight-bold"
                                            href="{{ route('admin.settings.area-section.edit') }}">Area Section</a>
                                        <p class="text-muted ml-3 font-weight-light">View and update area section
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@section('custom-js')
@endsection
@endsection
