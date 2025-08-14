<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="description"
        content="Browse properties for rent and sale in Dublin, Cork, Galway, Limerick, Waterford, and across Ireland. EireHome makes finding your next home simple and secure.">
    <meta name="keywords"
        content="Ireland property, property for sale, property for rent, EireHome, Irish homes, commercial property Ireland, residential listings Ireland, Dublin property, Cork property, Galway property, Limerick homes, Waterford property">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bs-theme-overrides.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@4.5.1/es2015/jodit.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/xToggle.css') }}">
    <link rel="icon" href="{{ asset('uploads/frontend_images/' . Config()->get('settings.favicon')) }}"
        type="image/x-icon">
    <meta name="_token" content="{{ csrf_token() }}">
</head>

<body>
    <header>
        @include('frontend.layout.partials.mobile_nav')
        @include('frontend.layout.partials.navbar')

    </header>
    @yield('content')

    @include('frontend.layout.partials.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jodit@4.5.1/es2015/jodit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/xToggle-Toggle.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/youtube_iframe.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let toastEl = document.getElementById("liveToast");
            if (toastEl) {
                let toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
    @yield('script')
    <!-- Cookie Consent Card Popup -->
    <div id="cookieConsent"
        class="position-fixed bottom-0 start-50 translate-middle-x w-100 d-flex justify-content-center p-3 d-none"
        style="z-index: 1050;">
        <div class="card shadow-lg border-0 position-relative" style="max-width: 720px; width: 100%;">

            <!-- Close Icon (Fixed without overriding) -->
            <div class="position-absolute top-0 end-0 p-2" style="z-index: 2;">
                <button type="button" class="btn-close" aria-label="Close" id="closeCookies"></button>
            </div>

            <div class="card-body d-flex pt-4"> <!-- pt-4 to give space for close icon -->
                <!-- Cookie Icon -->
                <div class="me-3 d-flex align-items-start">
                    <span style="font-size: 1.8rem;">🍪</span>
                </div>

                <!-- Text and Accept Button -->
                <div class="flex-grow-1">
                    <p class="mb-3 text-muted">
                        We use cookies to enhance your browsing experience, serve personalized ads, and analyze our
                        traffic.
                        By clicking <strong>"Accept"</strong>, you consent to our use of cookies in accordance with our
                        <a href="/cookie-policy" class="text-decoration-underline">Cookie Policy</a>.
                    </p>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success btn-sm" id="acceptCookies">Accept</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cookieBanner = document.getElementById("cookieConsent");
            const acceptBtn = document.getElementById("acceptCookies");
            const closeBtn = document.getElementById("closeCookies");

            if (!localStorage.getItem("cookiesAccepted")) {
                cookieBanner.classList.remove("d-none");
            }

            acceptBtn.addEventListener("click", function() {
                localStorage.setItem("cookiesAccepted", true);
                cookieBanner.classList.add("d-none");
            });

            closeBtn.addEventListener("click", function() {
                cookieBanner.classList.add("d-none");
            });
        });
    </script>

</body>

</html>
