<footer>
    <div class="container">
        <div class="row">
            <!-- Logo Section -->
            <div class="col-lg-3 col-12 text-center">
                <img src="{{ asset('uploads/frontend_images/' . Config('settings.logo')) }}" alt="Company Logo"
                    class="footer-logo">
            </div>

            <!-- About Us Section -->
            <!-- Legal Section -->
            @if (companyPages()->count() > 0)
                <div class="col-lg-3 col-6 footer-column">
                    <h3>{{ Str::ucfirst(companyPages()->first()->menu_name) }}</h3>
                    <ul>
                        @foreach (companyPages() as $page)
                            <li>
                                <a href="{{ route('front.page', $page->slug) }}">{{ Str::ucfirst($page->title) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Legal Section -->
            @if (legalPages()->count() > 0)
                <div class="col-lg-3 col-6 footer-column">
                    <h3>{{ Str::ucfirst(legalPages()->first()->menu_name) }}</h3>
                    <ul>
                        @foreach (legalPages() as $page)
                            <li>
                                <a href="{{ route('front.page', $page->slug) }}">{{ Str::ucfirst($page->title) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Contact Section -->
            <div class="col-lg-3 col-md-12 footer-column">
                <h3>Contact</h3>
                <ul>
                    <li>Address : {{ getContactInfo()->address }}</li>
                    <li>Email: <a href="mailto:{{ getContactInfo()->email }}">{{ getContactInfo()->email }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; {{ Config('settings.copyright_text') }}&nbsp;<span>{{ date('Y') }}</span>. All rights reserved.
        </p>
    </div>
</footer>
