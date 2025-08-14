<div class="offcanvas offcanvas-end w-75" tabindex="-1" data-bs-scroll="true" id="offcanvasNavbar">
    <div class="offcanvas-header shadow-sm">
        <a class="navbar-brand fs-4 fw-bold" href="{{ route('home') }}"><img class="img-fluid"
                src="{{ asset('uploads/frontend_images/' . Config('settings.logo')) }}" width="180px" /></a><button
            class="btn-close shadow-none" type="button" aria-label="Close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column navbar navbar-nav align-items-start">
            @if (Auth::check())
                <p class="fw-bold text-primary mb-0">Hello!&nbsp;{{ Auth::user()->name }}</p>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('favorites.index') }}">My Favorate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.my.property') }}">My Properties</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.profile') }}">Accounts</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">Logout</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login/Register</a></li>
            @endif
        </ul>
        <hr class="divider" />
        <ul class="nav flex-column navbar navbar-nav align-items-start">
            @foreach (getNavbarMenu() as $adType)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $adType->id }}"
                        role="button" data-bs-toggle="dropdown">
                        @if ($adType->name == 'sale')
                            Buy
                        @else
                            {{ ucfirst($adType->name) }}
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($adType->propertyTypes as $propertyType)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('properties.index', ['adType' => $adType->name, 'propertyType' => $propertyType->name]) }}">{{ ucfirst($propertyType->name) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            <!-- Static Menu Items -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown3" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Share
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('properties.index', ['adType' => 'share', 'type' => 'student accommodation']) }}">
                            Student Acommodations
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown4" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Commercial
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('properties.index', ['adType' => 'commercial', 'category' => '2']) }}">
                            To Lease
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('properties.index', ['adType' => 'commercial', 'category' => '2']) }}">
                            For Sale
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">New Homes</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown4" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Services
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#">
                            Auctioneer
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Surveyors
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Solicitors
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Accountant
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Mortgage Brokers
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Insurance Providers
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Builder
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Roofer
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Electrician
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Plumbers
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Joinery
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Interior Designer
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            Furniture
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Mortgage</a>
            </li>
        </ul>
        <hr class="divider" />
        <div class="d-grid">
            <a class="btn btn-success" href="{{ route('user.select.ads.type') }}">Post Ads</a>
        </div>
        <hr class="divider" />
        <a class="text-decoration-none" href="tel:{{ getContactInfo()->phone }}"><i
                class="fas fa-phone-alt"></i>&nbsp;
            {{ getContactInfo()->phone }}</a>
        <hr class="divider" />
        <a class="text-decoration-none" href="mailto:{{ getContactInfo()->email }}"><i
                class="fas fa-envelope"></i>&nbsp;
            {{ getContactInfo()->email }}</a>
    </div>
</div>
