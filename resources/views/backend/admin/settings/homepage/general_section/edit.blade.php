@extends('backend.admin.layout.master')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="d-flex justify-content-between">
                    <h1>General Settings</h1>
                    <a href="{{ route('admin.settings') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
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
                    <form action="{{ route('admin.settings.general-section.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="website_title">Webiste Title</label>
                                        <input type="text" name="website_title" id="website_title"
                                            value="{{ $general_settings->webiste_title }}"
                                            class="form-control @error('website_title')
                                                is-invalid
                                            @enderror"
                                            placeholder="Website Title">
                                        @error('website_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="copyright_text">Copyright Text</label>
                                        <input type="text" name="copyright_text" id="copyright_text"
                                            value="{{ $general_settings->copyright_text }}"
                                            class="form-control @error('copyright_text')
                                                is-invalid
                                            @enderror"
                                            placeholder="Copyright Text">
                                        @error('copyright_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <img src="{{ asset('uploads/frontend_images/' . $general_settings->logo) }}"
                                        alt="" class="img-thumbnail" style="width: 200px;">
                                    <div class="mb-3">
                                        <label for="copyright_text">Website Logo</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('logo') is-invalid
                                            @enderror"
                                                name="logo" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <img src="{{ asset('uploads/frontend_images/' . $general_settings->favicon) }}"
                                        alt="" class="img-thumbnail" style="width: 56px;">
                                    <div class="mb-3">
                                        <label for="copyright_text">Favicon</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('facicon') is-invalid
                                            @enderror"
                                                name="facicon" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('facicon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="language">Select Language</label>
                                        <select name="language" id="language"
                                            class="form-control @error('language') is-invalid @enderror">
                                            <option value="">Select Language</option>
                                            <option value="en"
                                                {{ $general_settings->language == 'en' ? 'selected' : '' }}>English
                                            </option>
                                            <option value="hi"
                                                {{ $general_settings->language == 'hi' ? 'selected' : '' }}>Hindi</option>
                                        </select>
                                        @error('language')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="timezone">Select Timezone</label>
                                        <select name="timezone" id="timezone"
                                            class="form-control @error('timezone') is-invalid @enderror">
                                            @foreach ($timezones as $timezone)
                                                <option value="{{ $timezone->id }}"
                                                    {{ $timezone->id == $general_settings->timezone ? 'selected' : '' }}>
                                                    {{ $timezone->name }}
                                                    ({{ $timezone->offset }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('timezone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="currency">Select Currncy</label>
                                        <select name="currency" id="currency"
                                            class="form-control @error('currency') is-invalid @enderror">
                                            <option value="">Select Currency</option>
                                            <option value="USD"
                                                {{ $general_settings->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="INR"
                                                {{ $general_settings->currency == 'INR' ? 'selected' : '' }}>INR</option>
                                            <option value="EUR"
                                                {{ $general_settings->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                        </select>
                                        @error('currency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="currency_symbol">Select Currency Symbol</label>
                                        <select name="currency_symbol" id="currency_symbol"
                                            class="form-control @error('currency_symbol') is-invalid @enderror">
                                            <option value="">Select Currency Symbol</option>
                                            <option value="$"
                                                {{ $general_settings->currency_symbol == '$' ? 'selected' : '' }}>$
                                            </option>
                                            <option value="₹"
                                                {{ $general_settings->currency_symbol == '₹' ? 'selected' : '' }}>₹
                                            </option>
                                            <option value="€"
                                                {{ $general_settings->currency_symbol == '€' ? 'selected' : '' }}>€
                                            </option>
                                        </select>
                                        @error('currency_symbol')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="back_to_top"
                                                name="back_to_top"
                                                {{ $general_settings->back_to_top == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="back_to_top">Enable/Disable Back to
                                                Top</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
