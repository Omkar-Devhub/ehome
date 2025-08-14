<nav class="navbar navbar-expand-lg shadow-sm py-3 navbar-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}"><img class="img-fluid"
                src="{{ asset('uploads/frontend_images/' . Config('settings.logo')) }}" width="140px" /></a><button
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" class="navbar-toggler border-0 shadow-none">
            <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
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
                                href="{{ route('properties.index', ['adType' => 'rent', 'category' => '2']) }}">
                                To Lease
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('properties.index', ['adType' => 'sale', 'category' => '2']) }}">
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
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                            href="#">
                            {{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" data-bs-popper="none">
                            <a class="dropdown-item" href="{{ route('favorites.index') }}">My Favorite</a>
                            <a class="dropdown-item" href="{{ route('user.my.property') }}">My Properties</a>
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Account</a>
                            <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login/Register</a>
                    </li>
                @endif
            </ul>
            <a class="btn btn-primary link-light ms-3" href="{{ route('user.select.ads.type') }}">
                <i class="fas fa-plus"></i>&nbsp; Place an Ad
            </a>
        </div>
    </div>
</nav>
